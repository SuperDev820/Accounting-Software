<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BankController extends Controller
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
        $banks = Bank::all();

        return response()->json([
            'message' => 'success',
            'banks' => $banks
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $bankId)
    {
        $bank = Bank::find($bankId);

        return response()->json([
            'message' => 'success',    
            'bank' => $bank,
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

        $bank = Bank::create([
            'Nombre' => $request->name,
            'Oficina' => $request->office,
            'IBAN' => $request->iban,
            'SWIFT' => $request->bic,
        ]);
        
        return response()->json([
            'message' => 'Banco Creado Correctamente',
            'bank' => $bank
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
        // Update sale$bank
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $bank = Bank::find($request->id);
        $bank -> update([
            'Nombre' => $request->name,
            'Oficina' => $request->office,
            'IBAN' => $request->iban,
            'SWIFT' => $request->bic,
        ]);

        return response()->json([
            'message' => 'Banco Actualizado Correctamente',
            'bank' => $bank
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $bankId)
    {
        //delete sale$bank
        $bank = Bank::find($bankId);
        $bank -> delete();
        $banks = Bank::all();

        return response()->json([
            'message' => 'Banco Eliminado Correctamente',
            'banks' => $banks
        ], 200);
    }
}
