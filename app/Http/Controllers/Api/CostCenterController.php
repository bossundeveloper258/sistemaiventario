<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\BaseController as BaseController;

use App\Models\CostCenter;
use App\Models\Area;
use App\Models\Sede;
use App\Models\Business;
use App\Http\Requests\CostCenter\CostCenterCreateRequest;
use App\Http\Requests\CostCenter\CostCenterUpdateRequest;

class CostCenterController extends BaseController
{
    //
    public function findAll()
    {
        
        $costcenters = CostCenter::with(['business','sede','area'])
            // ->where( "user_id" , "=" , Auth::user()->id )
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($costcenters, 'List');
    }

    public function search(Request $request)
    {
        $costcenters = CostCenter::with(['business','sede','area']);
        if( !$request->has('area') ) $costcenters = $costcenters->where( "area_id" , "=" , $request->query('area') );
        if( !$request->has('sede') ) $costcenters = $costcenters->where( "sede_id" , "=" , $request->query('sede') );
        if( !$request->has('business') ) $costcenters = $costcenters->where( "business_id" , "=" , $request->query('business') );
        $costcenters = $costcenters->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($costcenters, 'List');
    }

    public function create(CostCenterCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $costcenter = CostCenter::create([
                'code'          => $data->code,
                'name'          => $data->name,
                'area_id'       => $data->area_id,
                'sede_id'       => $data->sede_id,
                'business_id'   => $data->business_id,
                // 'user_id'       => Auth::user()->id,
            ]);

            return $this->sendResponse($costcenter->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function edit($id)
    {
        try {

            $costcenter = CostCenter::find($id);

            if( $costcenter == null ) return $this->sendError('No se encontro informacion.');
            
            return $this->sendResponse($costcenter, '');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function update( CostCenterUpdateRequest $request, $id )
    {
        try {

            $currentcostcenter = CostCenter::find($id);

            if( $currentcostcenter == null ) return $this->sendError('Centro de costo no existe');

            // if( $currentArea->user_id != Auth::user()->id ) return $this->sendError('No tiene permisos');

            $data = (object) $request->all();

            $update = array(
                'code'          => $data->code,
                'name'          => $data->name,
                'area_id'       => $data->area_id,
                'sede_id'       => $data->sede_id,
                'business_id'   => $data->business_id,
            );

            $costcenter = CostCenter::where('id', $id)->update($update);
            
            return $this->sendResponse($costcenter, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }
}
