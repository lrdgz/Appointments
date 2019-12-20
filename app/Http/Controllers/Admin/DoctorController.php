<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Specialty;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $doctors = User::doctors()->paginate(15);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
            'name'      => 'required|min:3',
            'email'     => 'required|email',
            'dni'       => 'nullable|digits:8',
            'address'   => 'nullable|min:8',
            'phone'     => 'nullable|min:6'
        ]);

        $data = $request->only('name', 'email', 'dni', 'address', 'phone') + ['role' => 'doctor', 'password' => bcrypt($request->get('password'))];
        $user = User::create($data);

        $user->specialties()->attach($request->input('specialties'));

        $notification = 'El Doctor se ha registrado satisfactoriamente!';
        $type = 'success';
        return redirect('/doctors')->with(compact('notification','type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $specialties = Specialty::all();
        $doctor = User::doctors()->findOrFail($id);
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor','specialties','specialty_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, [
            'name'      => 'required|min:3',
            'email'     => 'required|email',
            'dni'       => 'nullable|digits:8',
            'address'   => 'nullable|min:8',
            'phone'     => 'nullable|min:6'
        ]);

        $data = $request->only('name', 'email', 'dni', 'address', 'phone');
        $password = $request->input('password');

        if($password)
            $data['password'] = bcrypt($password);

        $user = User::doctors()->findOrFail($id);
        $user->fill($data);
        $user->save();

        $user->specialties()->sync($request->input('specialties'));

        $notification = 'El Doctor se ha actualizado satisfactoriamente!';
        $type = 'warning';
        return redirect('/doctors')->with(compact('notification','type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor){
        $deletedDoctor = $doctor->name;
        $doctor->delete();

        $notification = "El doctor <b>$deletedDoctor</b> se ha eliminado satisfactoriamente!";
        $type = 'warning';
        return redirect('/doctors')->with(compact('notification','type'));
    }
}
