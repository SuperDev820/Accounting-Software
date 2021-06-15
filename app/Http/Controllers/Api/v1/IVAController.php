<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\IVA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class IVAController extends Controller
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
        $all_IVA = IVA::all();

        return response()->json([
            'message' => 'success',
            'all_IVA' => $all_IVA
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $IVAId)
    {
        $IVA = IVA::find($IVAId);

        return response()->json([
            'message' => 'success',    
            'IVA' => $IVA,
        ], 200);
    }

    /**
     * Create new data
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $IVA = IVA::create([
            'Descripcion' => $request->name,
        ]);
        
        return response()->json([
            'message' => 'IVA Creado Correctamente',
            'IVA' => $IVA
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
        // Update sale$IVA
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $IVA = IVA::find($request->id);
        $IVA -> update([
            'Descripcion' => $request->name,
        ]);

        return response()->json([
            'message' => 'IVA Actualizado Correctamente',
            'IVA' => $IVA
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $IVAId)
    {
        //delete sale$IVA
        $IVA = IVA::find($IVAId);
        $IVA -> delete();
        $all_IVA = IVA::all();

        return response()->json([
            'message' => 'IVA Eliminado Correctamente',
            'all_IVA' => $all_IVA
        ], 200);
    }
}
