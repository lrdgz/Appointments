<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

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
        return view('doctors.create');
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
        User::create($data);

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
        $doctor = User::doctors()->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
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
