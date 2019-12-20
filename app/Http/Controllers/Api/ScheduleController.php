<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller{

    public function hours(Request $request){

        $rules = [
            'date' => 'required|date_format:"Y-m-d"',
            'doctor_id' => 'required|exists:users,id'
        ];

        $this->validate($request, $rules);

        $date = $request->input('date');
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;

        //carbon: 0 (sunday) - 6 (saturday)
        //WorkDay: 0 (monday) - 6 (sunday)
        $day = ($i == 0 ? 6 : $i - 1);

        $doctorID = $request->input('doctor_id');
        $workDay = WorkDay::where('active',true)
            ->where('day',$day)
            ->where('user_id',$doctorID)
            ->first(['morning_start','morning_end','afternoon_start','afternoon_end']);
        dd($workDay->toArray());
    }

}
