<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\Role;
use App\Models\Parameter;
use App\Models\Business;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Sede\SedeCreateRequest;
use App\Http\Requests\Sede\SedeUpdateRequest;
use Illuminate\Support\Facades\Validator;

class SedeController extends BaseController
{
    //
    public function findAll()
    {
        
        $sedes = Sede::with(['business','sede_type'])
            // ->where( "user_id" , "=" , Auth::user()->id )
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($sedes, 'List');
    }

    public function search(Request $request)
    {
        $sedes = Sede::with([]);
        if( !$request->has('business') ) $sedes = $sedes->where( "business_id" , "=" , $request->query('business') );
        $sedes = $sedes->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($sedes, 'List');
    }

    public function create(SedeCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $sede = Sede::create([
                'name'          => $data->name,
                'address'       => $data->address,
                'sede_type_id'  => $data->sede_type,
                'business_id'   => $data->business_id,
                'user_id'       => Auth::user()->id,
            ]);

            return $this->sendResponse($sede->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function edit($id)
    {
        try {

            $sede = Sede::find($id);

            if( $sede == null ) return $this->sendError('No se encontro informacion.');
            
            return $this->sendResponse($sede, '');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function update( SedeUpdateRequest $request, $id )
    {
        try {

            $currentSede = Sede::find($id);

            if( $currentSede == null ) return $this->sendError('Sede no existe');

            if( $currentSede->user_id != Auth::user()->id ) return $this->sendError('No tiene permisos');

            $data = (object) $request->all();

            $update = array(
                'name'          => $data->name,
                'address'       => $data->address,
                'sede_type_id'  => $data->sede_type,
                'business_id'   => $data->business_id
            );

            $sede = Sede::where('id', $id)->update($update);
            
            return $this->sendResponse($sede, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }
}
