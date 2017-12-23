<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Illuminate\Support\Facades\Auth;

class PacotesController extends Controller
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
}
