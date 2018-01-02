<?php
//https://laravelcode.com/post/laravel-full-calendar-tutorial-example-using-maddhatter-laravel-fullcalendar
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Event;
use Session;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
class EventController extends Controller
{
    public function index()
    {
        
        $events = [];
        $data = Event::all();
        if($data->count()) {
            foreach ($data as $key => $value) {

                $events[] = Calendar::event(
                    $value->title,
                    false, //full day event?
                    $value->start_date,
                    $value->end_date,
                    null,
                    // Add color and link on event
                    [
                        
                        'color' => $value->color,
                        'url' => 'pass here url and any route',
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('services', compact('calendar'));
        
    }
    public function addClass(Request $req){
        //dd($req);

       $users = DB::table('events')->where('room', 100)->get();


        $title = $req->input('title');
        $room = $req->input('room');
        $start_date= $req->input('start_date');
        $end_date= $req->input('end_date');
        $color= $req->input('color');
        
        //dd($room);

        $sala_ocupada = DB::table('events')->where('room', $room)->get();
        $horai_ocupada = DB::table('events')->where('start_date', $start_date)->get();
        $horaf_ocupada = DB::table('events')->where('end_date', $end_date)->get();
        
        print_r($sala_ocupada);
        print_r($horai_ocupada);
        print_r($horaf_ocupada);


        if(empty($sala_ocupada) OR empty($horai_ocupada) OR empty($horaf_ocupada)){
           //echo "Sala ocupada";
           Session::flash('event', 'Sala ocupada!');
           return redirect("/services");
           
        }else{
            $data = [
            ['title'=>$title, 'room'=>$room,'start_date'=>$start_date, 'end_date'=>$end_date, 'color'=>$color],
            ];
            DB::table('events')->insert($data); 

            //echo "Aula inserida";
            Session::flash('event', 'Aula inserida com sucesso!');
            return redirect("/services");
            
        }
    }
}
