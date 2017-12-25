<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlanController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all plans from stripe api
        $plans = Plan::getStripePlans();

        // Check is subscribed
        $is_subscribed = Auth::user()->subscribed('main');

        // If subscribed get the subscription
        $subscription = Auth::user()->subscription('main');

        return view('pacotes', compact('plans', 'is_subscribed', 'subscription'));
    }


    /**
     * Show Plan with form to subscribe
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        // get the plan by id from cache
        $plan = $this->getPlanByIdOrFail($id);

        return view('plan', compact('plan'));
    }

    /**
     * Handle subscription request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        // Validate request
        $this->validate( $request, [ 'stripeToken' => 'required', 'plan' => 'required'] );

        // User chosen plan
        $pickedPlan = $request->get('plan');

        //dd($pickedPlan);
        // Current logged in user
        $me = Auth::user();

        try {
            // check already subscribed and if already subscribed with picked plan
            if( $me->subscribed('main') && ! $me->subscribedToPlan($pickedPlan, 'main') ) {

                // swap if different plan attempt
                $me->subscription('main')->swap($pickedPlan);

            } else {
                // Its new subscription

                // if user has a coupon, create new subscription with coupon applied
                if( $coupon = $request->get('coupon') ) {

                    $me->newSubscription( 'main', $pickedPlan)
                        ->withCoupon($coupon)
                        ->create($request->get('stripeToken'), [
                            'email' => $me->email
                        ]);

                } else {

                    // Create subscription
                    $me->newSubscription( 'main', $pickedPlan)->create($request->get('stripeToken'), [
                        'email' => $me->email,
                        'description' => $me->name
                    ]);
                }

            }
        } catch (\Exception $e) {
            // Catch any error from Stripe API request and show
           return redirect()->back()->withErrors(['status' => $e->getMessage()]);
        }

        return redirect()->route('plano')->with('status', 'You are now subscribed to ' . $pickedPlan . ' plan.');
    }

    /**
     * Show subscription cancellation confirmation screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmCancellation()
    {
        return view('confirmation');
    }

    /**
     * Handle subscription cancellation request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelSubscription(Request $request)
    {
        //dd($request->user()->subscription('main')->cancel());
        try {
            $request->user()->subscription('main')->cancel();
        } catch ( \Exception $e) {
            return redirect()->route('plano')->with('status', $e->getMessage());
        }

        return redirect()->route('plano')->with('status',
            'Your Subscription has been canceled.'
        );
    }

    /**
     * Handle Resume subscription
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resumeSubscription(Request $request)
    {
        try {
            $request->user()->subscription('main')->resume();
        } catch ( \Exception $e) {
            return redirect()->route('plan')->with('status', $e->getMessage());
        }

        return redirect()->route('plano')->with('status',
            'Glad to see you back. Your Subscription has been resumed.'
        );
    }

    /**
     * Get Cached Plan by Id
     * @param $id
     * @return mixed
     */
    private function getPlanByIdOrFail($id)
    {
        $plans = Plan::getStripePlans();

        if( ! $plans ) throw new NotFoundHttpException;

        return array_first(array_filter( $plans, function($plan) use ($id) {
            return $id == $plan->id;
        }));
    }
}
