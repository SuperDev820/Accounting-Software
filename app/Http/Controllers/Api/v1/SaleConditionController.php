<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\SaleCondition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class SaleConditionController extends Controller
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
        $sale_conditions = SaleCondition::all();

        return response()->json([
            'message' => 'success',
            'sale_conditions' => $sale_conditions
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $conditionId)
    {
        $sale_condition = SaleCondition::find($conditionId);

        return response()->json([
            'message' => 'success',    
            'sale_condition' => $sale_condition,
        ], 200);
    }

    /**
     * Create new data
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'CondicionVenta' => 'required|unique:m_condicionesventa',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $sale_condition = SaleCondition::create([
            'CondicionVenta' => $request->CondicionVenta,
            'Descripcion' => $request->description,
        ]);
        
        return response()->json([
            'message' => 'CondicionVenta Creado Correctamente',
            'sale_condition' => $sale_condition
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
        // Update sale$sale_condition
        $validator = Validator::make($request->all(), [
            'CondicionVenta' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $sale_condition = SaleCondition::find($request->id);
        $sale_condition -> update([
            'CondicionVenta' => $request->CondicionVenta,
            'Descripcion' => $request->description,
        ]);

        return response()->json([
            'message' => 'CondicionVenta Actualizado Correctamente',
            'sale_condition' => $sale_condition
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $conditionId)
    {
        //delete sale$sale_condition
        $sale_condition = SaleCondition::find($conditionId);
        $sale_condition -> delete();
        $sale_conditions = SaleCondition::all();

        return response()->json([
            'message' => 'CondicionVenta Eliminado Correctamente',
            'sale_conditions' => $sale_conditions
        ], 200);
    }
}
