<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dni', 'address', 'phone', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function specialties(){
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

    //appointmentsAsDoctor -> attendedAppointments
    //appointmentsAsPatient -> requestedAppointments

    public function asPatientAppointments(){
        return $this->hasMany(Specialty::class, 'patient_id');
    }

    public function asDoctorAppointments(){
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function attendedAppointments(){
        return $this->asDoctorAppointments()->where('status','Atendida');
    }

    public function cancelAppointments(){
        return $this->asDoctorAppointments()->where('status','Cancelada');
    }


    public function scopePatients($query){
        return $query->where('role','patient');
    }

    public function scopeDoctors($query){
        return $query->where('role','doctor');
    }
}
