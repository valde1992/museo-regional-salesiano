<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Clasificacion;
use Validator;

class ClasificacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clasificaciones = Clasificacion::all();
        return view("clasificaciones.index", compact("clasificaciones"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clasificaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Clasificacion::rules(), Clasificacion::messages());

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator);
        }

        $clasificacion = $request->all();
        Clasificacion::create($clasificacion);
        return redirect('clasificaciones')->with('success', ' La clasificación ha sido cargada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clasificacion = Clasificacion::find($id);
        return view('clasificaciones.show',compact('clasificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clasificacion = Clasificacion::find($id);
        return view('clasificaciones.edit',compact('clasificacion'));
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
        $validator = Validator::make($request->all(), Clasificacion::rules(), Clasificacion::messages());

        if($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator);
        }

        $clasificacionUpdate = $request->all();
        $clasificacion = Clasificacion::find($id);
        $clasificacion->update($clasificacionUpdate);
        return redirect('clasificaciones')->with('success', ' La clasificación ha sido cargada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clasificacion::find($id)->delete();
        return redirect('clasificaciones');
    }
}
