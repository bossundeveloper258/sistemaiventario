<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Computer;
use App\Http\Requests\Computer\ComputerCreateRequest;
use App\Http\Requests\Computer\ComputerUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ComputerController extends BaseController
{
    //
    public function findAll()
    {
        $computers = Computer::with(['type','brand','model','so','status','supplier','ceco','employee','business','sede', 'area'])
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($computers, 'List');
    }

    public function create(ComputerCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $computer = Computer::create([
                'type_id'               => $data->type_id ?? null,
                'brand_id'              => $data->brand_id ?? null,
                'model_id'              => $data->model_id ?? null,
                'number_serie'          => $data->number_serie ?? null,
                'number_inventory'      => $data->number_inventory ?? null,
                'act_fijo'              => $data->act_fijo ?? null,
                'name'                  => $data->name ?? null,
                'so_id'                 => $data->so_id ?? null,
                'cod_bitlocker'         => $data->cod_bitlocker ?? null,
                'processor'             => $data->processor ?? null,
                'ram'                   => $data->ram ?? null,
                'hdd'                   => $data->hdd ?? null,
                'date_start_guarantee'  => explode("T", $data->date_start_guarantee ?? '')[0] ?? null,
                'date_exp_guarantee'    => explode("T", $data->date_exp_guarantee ?? '')[0] ?? null,
                'date_capital'          => explode("T", $data->date_capital ?? '')[0] ?? null,
                'status_id'             => $data->status_id ?? null,
                'number_capex'          => $data->number_capex ?? null,
                'name_capex'            => $data->name_capex ?? null,
                'pep_number'            => $data->pep_number ?? null,
                'solped'                => $data->solped ?? null,
                'oc'                    => $data->oc ?? null,
                'pe_migo'               => $data->pe_migo ?? null,
                'factura'               => $data->factura ?? null,
                'amount'                => $data->amount ?? null,
                'supplier_id'           => $data->supplier_id ?? null,
                'business_id'           => $data->business_id ?? null,
                'sede_id'               => $data->sede_id ?? null,
                'area_id'               => $data->area_id ?? null,
                'ceco_id'               => $data->ceco_id ?? null,
                'employee_id'           => $data->employee_id ?? null,
                'user_id'               => Auth::user()->id,
            ]);

            return $this->sendResponse($computer->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function edit($id)
    {
        try {

            $computer = Computer::find($id);

            if( $computer == null ) return $this->sendError('No se encontro informacion.');
            
            return $this->sendResponse($computer, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function update( ComputerUpdateRequest $request, $id )
    {
        try {

            $currentcomputer = Computer::find($id);

            if( $currentcomputer == null ) return $this->sendError('Empresa no existe');

            // if( $currentBusiness->user_id != Auth::user()->id ) return $this->sendError('No tiene permisos');

            $data = (object) $request->all();

            $update = array(
                'type_id'               => $data->type_id ?? null,
                'brand_id'              => $data->brand_id ?? null,
                'model_id'              => $data->model_id ?? null,
                'number_serie'          => $data->number_serie ?? null,
                'number_inventory'      => $data->number_inventory ?? null,
                'act_fijo'              => $data->act_fijo ?? null,
                'name'                  => $data->name ?? null,
                'so_id'                 => $data->so_id ?? null,
                'cod_bitlocker'         => $data->cod_bitlocker ?? null,
                'processor'             => $data->processor ?? null,
                'ram'                   => $data->ram ?? null,
                'hdd'                   => $data->hdd ?? null,
                'date_start_guarantee'  => explode("T", $data->date_start_guarantee ?? '')[0] ?? null,
                'date_exp_guarantee'    => explode("T", $data->date_exp_guarantee ?? '')[0] ?? null,
                'date_capital'          => explode("T", $data->date_capital ?? '')[0] ?? null,
                'status_id'             => $data->status_id ?? null,
                'number_capex'          => $data->number_capex ?? null,
                'name_capex'            => $data->name_capex ?? null,
                'pep_number'            => $data->pep_number ?? null,
                'solped'                => $data->solped ?? null,
                'oc'                    => $data->oc ?? null,
                'pe_migo'               => $data->pe_migo ?? null,
                'factura'               => $data->factura ?? null,
                'amount'                => $data->amount ?? null,
                'supplier_id'           => $data->supplier_id ?? null,
                'business_id'               => $data->business_id ?? null,
                'sede_id'               => $data->sede_id ?? null,
                'area_id'               => $data->area_id ?? null,
                'ceco_id'               => $data->ceco_id ?? null,
                'employee_id'           => $data->employee_id ?? null
            );

            $computer = Computer::where('id', $id)->update($update);
            
            return $this->sendResponse($computer, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

}
