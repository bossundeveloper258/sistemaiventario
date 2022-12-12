<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\Role;
use App\Models\Parameter;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Business\BusinessCreateRequest;
use App\Http\Requests\Business\BusinessUpdateRequest;
use Illuminate\Support\Facades\Validator;

class BusinessController extends BaseController
{
    //

    public function findAll()
    {
        
        // $business = Business::where( "user_id" , "=" , Auth::user()->id );

        $business = Business::orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($business, 'List');
    }

    public function search(Request $request)
    {
        $business = Business::with([]);
        if( $request->has('status') ) $business = $business->where( "status" , $request->query('status') );
        $business = $business->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($business, 'List aaaa');
    }

    public function create(BusinessCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $business = Business::create([
                'ruc' => $data->ruc,
                'name' => $data->name,
                'address' => $data->address,
                'user_id' => Auth::user()->id,
            ]);

            return $this->sendResponse($business->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function edit($id)
    {
        try {

            $business = Business::find($id);

            if( $business == null ) return $this->sendError('No se encontro informacion.');
            
            return $this->sendResponse($business, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function update( BusinessUpdateRequest $request, $id )
    {
        try {

            $currentBusiness = Business::find($id);

            if( $currentBusiness == null ) return $this->sendError('Empresa no existe');

            // if( $currentBusiness->user_id != Auth::user()->id ) return $this->sendError('No tiene permisos');

            $data = (object) $request->all();

            $update = array(
                "ruc" => $data->ruc,
                'name' => $data->name,
                'address' => $data->address,
            );

            $business = Business::where('id', $id)->update($update);
            
            return $this->sendResponse($business, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }


    public function updateStatus( Request $request , $id)
    {
        try {
            $currentBusiness = Business::find($id);
            if( $currentBusiness == null ) return $this->sendError('Empresa no existe');

            $validator = Validator::make($request->all(),[
                'status' => 'required|boolean',
            ]); 
    
            if($validator->fails()) {          
                return $this->sendError('Error Validacion', ['error'=> $validator->errors() ]);
            }

            $data = (object) $request->all();

            $update = array(
                "status" => $data->status == 1? true : false,
            );

            $user = Business::where('id', $id)->update($update);
            
            return $this->sendResponse($user, 'Cambio estado');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

}
