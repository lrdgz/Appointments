<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApprovedAppointment extends Model{

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function approved_by(){
        return $this->belongsTo(User::class);
    }
}
