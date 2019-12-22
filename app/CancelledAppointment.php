<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelledAppointment extends Model{

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function cancelled_by(){
        return $this->belongsTo(User::class);
    }

}
