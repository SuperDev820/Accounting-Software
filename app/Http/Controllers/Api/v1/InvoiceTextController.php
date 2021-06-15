<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\InvoiceText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class InvoiceTextController extends Controller
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
        $invoice_texts = InvoiceText::all();

        return response()->json([
            'message' => 'success',
            'invoice_texts' => $invoice_texts
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $invoiceTextId)
    {
        $invoice_text = InvoiceText::find($invoiceTextId);

        return response()->json([
            'message' => 'success',    
            'invoice_text' => $invoice_text,
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

        $invoice_text = InvoiceText::create([
            'Descripcion' => $request->name,
        ]);
        
        return response()->json([
            'message' => 'Textos de Factura Creado Correctamente',
            'invoice_text' => $invoice_text
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
        // Update sale$invoice_text
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $invoice_text = InvoiceText::find($request->id);
        $invoice_text -> update([
            'Descripcion' => $request->name,
        ]);

        return response()->json([
            'message' => 'Textos de Factura Actualizado Correctamente',
            'invoice_text' => $invoice_text
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $invoiceTextId)
    {
        //delete sale$invoice_text
        $invoice_text = InvoiceText::find($invoiceTextId);
        $invoice_text -> delete();
        $invoice_texts = InvoiceText::all();

        return response()->json([
            'message' => 'Textos de Factura Eliminado Correctamente',
            'invoice_texts' => $invoice_texts
        ], 200);
    }
}
