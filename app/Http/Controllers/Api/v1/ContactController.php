<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ContactController extends Controller
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
        $contacts = Contact::all();

        return response()->json([
            'message' => 'success',
            'contacts' => $contacts
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $contactId)
    {
        $contact = Contact::find($contactId);

        return response()->json([
            'message' => 'success',    
            'contact' => $contact,
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

        $contact = Contact::create([
            'Nombre' => $request->name,
            'Oficina' => $request->office,
            'IBAN' => $request->iban,
            'SWIFT' => $request->bic,
        ]);
        
        return response()->json([
            'message' => 'Banco Creado Correctamente',
            'contact' => $contact
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
        // Update sale$contact
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $contact = Contact::find($request->id);
        $contact -> update([
            'Nombre' => $request->name,
            'Oficina' => $request->office,
            'IBAN' => $request->iban,
            'SWIFT' => $request->bic,
        ]);

        return response()->json([
            'message' => 'Banco Actualizado Correctamente',
            'contact' => $contact
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $contactId)
    {
        //delete sale$contact
        $contact = Contact::find($contactId);
        $contact -> delete();
        $contacts = Contact::all();

        return response()->json([
            'message' => 'Banco Eliminado Correctamente',
            'contacts' => $contacts
        ], 200);
    }
}
