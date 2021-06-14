<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CompanyController extends Controller
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
        $companies = Company::all();

        return response()->json([
            'message' => 'success',
            'companies' => $companies
        ], 200);
    }

    /**
     * Response one data by id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request, $companyId)
    {
        $company = Company::find($companyId);

        return response()->json([
            'message' => 'success',    
            'company' => $company,
        ], 200);
    }

    /**
     * Create new data
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'IdEmpresa' => 'required|between:1,3|unique:m_empresas',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $company = Company::create([
            'IdEmpresa' => $request->IdEmpresa,
            'Descripcion' => $request->name,
            'Ruta' => $request->image,
            'Titulo' => $request->title,
            'Direccion' => $request->direction,
            'Remite' => $request->return,
        ]);
        
        return response()->json([
            'message' => 'Empresa Creado Correctamente',
            'company' => $company
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
        // Update company
        $validator = Validator::make($request->all(), [
            'IdEmpresa' => 'required|between:1,3',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $company = Company::find($request->id);
        $company -> update([
            'IdEmpresa' => $request->IdEmpresa,
            'Descripcion' => $request->name,
            'Ruta' => $request->image,
            'Titulo' => $request->title,
            'Direccion' => $request->direction,
            'Remite' => $request->return,
        ]);

        return response()->json([
            'message' => 'Usuario Actualizado Correctamente',
            'company' => $company
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $companyId)
    {
        //delete company
        $company = Company::find($companyId);
        $company -> delete();
        $companies = Company::all();

        return response()->json([
            'message' => 'Usuario Eliminado Correctamente',
            'companies' => $companies
        ], 200);
    }
}
