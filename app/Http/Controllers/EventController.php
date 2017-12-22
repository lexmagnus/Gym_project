<?php

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
                return view('fullcalendar', compact('calendar'));
            }
}
