<?php
//https://laravelcode.com/post/laravel-full-calendar-tutorial-example-using-maddhatter-laravel-fullcalendar
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
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
    public function addClass($title, $room, $start_date, $end_date,$color){
        $this->title = $title;
        $this->room = $room;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->color = $color;
        
        $data = [
         ['title'=>$title, 'room'=>$room,'start_date'=>$start_date, 'end_date'=>$end_date, 'color'=>$color],
        ];
        \DB::table('events')->insert($data);
    }
}
