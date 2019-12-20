<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::patients()->paginate(15);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('patients.create');
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

        $data = $request->only('name', 'email', 'dni', 'address', 'phone') + ['role' => 'patient', 'password' => bcrypt($request->get('password'))];
        User::create($data);

        $notification = 'El paciente se ha registrado satisfactoriamente!';
        $type = 'success';
        return redirect('/patients')->with(compact('notification','type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $patient = User::patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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

        $user = User::patients()->findOrFail($id);
        $user->fill($data);
        $user->save();

        $notification = 'El paciente se ha actualizado satisfactoriamente!';
        $type = 'warning';
        return redirect('/patients')->with(compact('notification','type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient){
        $deletedPatient = $patient->name;
        $patient->delete();

        $notification = "El doctor <b>$deletedPatient</b> se ha eliminado satisfactoriamente!";
        $type = 'warning';
        return redirect('/patients')->with(compact('notification','type'));
    }
}
