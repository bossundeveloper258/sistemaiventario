<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

use App\Models\Area;

use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Area\AreaCreateRequest;
use App\Http\Requests\Area\AreaUpdateRequest;
use Illuminate\Support\Facades\Validator;

class AreaController extends BaseController
{
    //
    public function findAll()
    {
        
        $areas = Area::with(['business','sede'])
            // ->where( "user_id" , "=" , Auth::user()->id )
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($areas, 'List');
    }

    public function search(Request $request)
    {
        $areas = Area::with(['business','sede']);
        if( $request->has('sede') ) $areas = $areas->where( "sede_id" , "=" , (int) $request->query('sede') );
        if( $request->has('business') ) $areas = $areas->where( "business_id" , "=" , $request->query('business') );
        if( $request->has('status') ) $areas = $areas->where( "status" ,  $request->query('status') );
        $areas = $areas->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($areas, 'List aaaa');
    }

    public function create(AreaCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $area = Area::create([
                'name'          => $data->name,
                'sede_id'       => null,
                'business_id'   => $data->business_id,
                // 'user_id'       => Auth::user()->id,
            ]);

            return $this->sendResponse($area->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.', $th);
        }
    }

    public function edit($id)
    {
        try {

            $area = Area::find($id);

            if( $area == null ) return $this->sendError('No se encontro informacion.');
            
            return $this->sendResponse($area, '');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function update( AreaUpdateRequest $request, $id )
    {
        try {

            $currentArea = Area::find($id);

            if( $currentArea == null ) return $this->sendError('Area no existe');

            // if( $currentArea->user_id != Auth::user()->id ) return $this->sendError('No tiene permisos');

            $data = (object) $request->all();

            $update = array(
                'name'          => $data->name,
                'sede_id'       => $data->sede_id,
                'business_id'   => $data->business_id
            );

            $area = Area::where('id', $id)->update($update);
            
            return $this->sendResponse($area, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function updateStatus( Request $request , $id)
    {
        try {
            $currentArea = Area::find($id);
            if( $currentArea == null ) return $this->sendError('Area no existe');

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

            $area = Area::where('id', $id)->update($update);
            
            return $this->sendResponse($area, 'Cambio estado');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }
}
