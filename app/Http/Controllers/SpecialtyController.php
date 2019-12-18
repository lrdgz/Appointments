<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $specialties = Specialty::paginate(15);
        return view('specialties.index', compact('specialties'));
    }

    public function create(){
        return view('specialties.create');
    }

    private function performValidation(Request $request){
        $rules = [
            'name' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre',
            'name.min'      => 'como minimo nombre debe tener 3 caracteres',
        ];

        $this->validate($request, $rules, $messages);
    }

    public function store(Request $request){

        $this->performValidation($request);

        $specialty = new Specialty();
        $specialty->name = $request->get('name');
        $specialty->description = $request->get('description');
        $specialty->save();

        $notification = 'La especialidad se ha registrado satisfactoriamente!';
        $type = 'success';
        return redirect('/specialties')->with(compact('notification','type'));
    }

    public function edit(Specialty $specialty){
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty){

        $this->performValidation($request);

        $specialty->name = $request->get('name');
        $specialty->description = $request->get('description');
        $specialty->save();

        $notification = 'La especialidad se ha actualizado satisfactoriamente!';
        $type = 'warning';
        return redirect('/specialties')->with(compact('notification','type'));
    }

    public function destroy(Specialty $specialty){
        $deletedSpeciality = $specialty->name;
        $specialty->delete();

        $notification = 'La especialidad <b>'.$deletedSpeciality.'</b> se ha eliminado satisfactoriamente!';
        $type = 'warning';
        return redirect('/specialties')->with(compact('notification','type'));
    }
}
