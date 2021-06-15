<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Company;
use App\Models\SeriesInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class SeriesInvoiceController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth:api', ['except' => []]);
    }
    /**
     * Response all data
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $series = SeriesInvoice::orderBy('empresa_id','asc')->get();
        foreach($series as $serie) {
            $serie->company;
        }

        return response()->json([
            'message' => 'success',
            'series' => $series
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $serieId)
    {
        $serie = SeriesInvoice::find($serieId);
        $serie->company;

        return response()->json([
            'message' => 'success',    
            'serie' => $serie,
        ], 200);
    }

    /**
     * Create new data
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'company' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $company = Company::find($request->company);
        $company->series()->create([
            'Letra' => $request->lyrics,
            'Numero' => $request->number,
            'Anio' => $request->year,
        ]);
        
        return response()->json([
            'message' => 'Empresa Creado Correctamente',
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Update serie
        $validator = Validator::make($request->all(), [
            'company' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $serie = SeriesInvoice::find($request->id);
        $serie -> update([
            'empresa_id' => $request->company,
            'Letra' => $request->lyrics,
            'Numero' => $request->number,
            'Anio' => $request->year,
        ]);

        return response()->json([
            'message' => 'Usuario Actualizado Correctamente',
            'serie' => $serie
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $serieId)
    {
        //delete serie
        $serie = SeriesInvoice::find($serieId);
        $serie -> delete();
        $series = SeriesInvoice::orderBy('empresa_id','asc')->get();
        foreach($series as $serie) {
            $serie->company;
        }

        return response()->json([
            'message' => 'Usuario Eliminado Correctamente',
            'series' => $series
        ], 200);
    }
}
