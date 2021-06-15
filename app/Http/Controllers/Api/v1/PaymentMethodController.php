<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class PaymentMethodController extends Controller
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
        $payment_methods = PaymentMethod::all();

        return response()->json([
            'message' => 'success',
            'payment_methods' => $payment_methods
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $paymentMethodId)
    {
        $payment_method = PaymentMethod::find($paymentMethodId);

        return response()->json([
            'message' => 'success',    
            'payment_method' => $payment_method,
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

        $payment_method = PaymentMethod::create([
            'Descripcion' => $request->name,
            'ValorOperaciones' => $request->operation_values,
            'NFracciones' => $request->no_fractions,
        ]);
        
        return response()->json([
            'message' => 'forma de pago Creado Correctamente',
            'payment_method' => $payment_method
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
        // Update sale$payment_method
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $payment_method = PaymentMethod::find($request->id);
        $payment_method -> update([
            'Descripcion' => $request->name,
            'ValorOperaciones' => $request->operation_values,
            'NFracciones' => $request->no_fractions,
        ]);

        return response()->json([
            'message' => 'forma de pago Actualizado Correctamente',
            'payment_method' => $payment_method
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $paymentMethodId)
    {
        //delete sale$payment_method
        $payment_method = PaymentMethod::find($paymentMethodId);
        $payment_method -> delete();
        $payment_methods = PaymentMethod::all();

        return response()->json([
            'message' => 'forma de pago Eliminado Correctamente',
            'payment_methods' => $payment_methods
        ], 200);
    }
}
