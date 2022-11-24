<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

use App\Models\Area;

use App\Models\Sede;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Area\AreaCreateRequest;
use App\Http\Requests\Area\AreaUpdateRequest;

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
        $areas = Area::where( "1" , "=" , "1" );
        if( !$request->has('sede') ) $areas = $areas->where( "sede_id" , "=" , $request->query('sede') );
        if( !$request->has('business') ) $areas = $areas->where( "business_id" , "=" , $request->query('business') );
        $areas = $areas->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($areas, 'List');
    }

    public function create(AreaCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $area = Area::create([
                'name'          => $data->name,
                'sede_id'       => $data->sede_id,
                'business_id'   => $data->business_id,
                // 'user_id'       => Auth::user()->id,
            ]);

            return $this->sendResponse($area->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
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
}
