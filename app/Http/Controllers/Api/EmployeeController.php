<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

use App\Models\CostCenter;
use App\Models\Area;
use App\Models\Sede;
use App\Models\Business;
use App\Models\Employee;
use App\Http\Requests\Employee\EmployeeCreateRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends BaseController
{
    //
    public function findAll()
    {
        
        $employees = Employee::with(['cost_center' , 'area'])
            // ->where( "user_id" , "=" , Auth::user()->id )
            ->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($employees, 'List');
    }

    public function search(Request $request)
    {
        $employees = Employee::with(['cost_center' , 'area']);
        
        if( $request->has('cost_center') ) $employees = $employees->where( "cost_center_id" , "=" , $request->query('cost_center') );
        if( $request->has('area') ) $employees = $employees->where( "area" , "=" , $request->query('area') );
        if( $request->has('status') ) $employees = $employees->where( "status" , $request->query('status') );
        $employees = $employees->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($employees, 'List');
    }

    public function create(EmployeeCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $employee = Employee::create([
                'gpid'              => $data->gpid,
                'name'              => $data->name,
                'email'             => $data->email,
                'job'               => $data->job,
                'cost_center_id'    => $data->cost_center_id,
                // 'user_id'       => Auth::user()->id,
            ]);

            return $this->sendResponse($employee->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function edit($id)
    {
        try {

            $employee = Employee::find($id);

            if( $employee == null ) return $this->sendError('No se encontro informacion.');
            
            return $this->sendResponse($employee, '');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function update( EmployeeUpdateRequest $request, $id )
    {
        try {

            $currentEmployee = Employee::find($id);

            if( $currentEmployee == null ) return $this->sendError('Empleado no existe');

            // if( $currentArea->user_id != Auth::user()->id ) return $this->sendError('No tiene permisos');

            $data = (object) $request->all();

            $update = array(
                'gpid'              => $data->gpid,
                'name'              => $data->name,
                'email'             => $data->email,
                'job'               => $data->job,
                'cost_center_id'    => $data->cost_center_id,
            );

            $employee = Employee::where('id', $id)->update($update);
            
            return $this->sendResponse($employee, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function updateStatus( Request $request , $id)
    {
        try {
            $currentEmployee = Employee::find($id);
            if( $currentEmployee == null ) return $this->sendError('Empleado no existe');

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

            $employee = Employee::where('id', $id)->update($update);
            
            return $this->sendResponse($employee, 'Cambio estado');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }
}
