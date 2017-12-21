<?php

use Illuminate\Database\Seeder;

class AddDummyEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [
         ['title'=>'Zumba', 'room'=>12,'start_date'=>'2017-12-30T08:00', 'end_date'=>'2017-12-30T09:00', 'color'=>'Red'],
         ['title'=>'Powerjump','room'=>2, 'start_date'=>'2017-12-29T08:00:00', 'end_date'=>'2017-12-29T09:00:00', 'color'=>'Green'],
         ['title'=>'Ballet', 'room'=>1, 'start_date'=>'2017-12-28T08:00:00', 'end_date'=>'2017-12-28T09:00:00', 'color'=>'Blue'],
         ['title'=>'Yoga', 'room'=>8, 'start_date'=>'2017-12-27T08:00:00', 'end_date'=>'2017-12-27T09:00:00', 'color'=>'Grey'],
         ['title'=>'Yoga', 'room'=>8, 'start_date'=>'2017-12-26T08:00:00', 'end_date'=>'2017-12-26T09:00:00', 'color'=>'Grey'],
        ];
        \DB::table('events')->insert($data);
    }
}
