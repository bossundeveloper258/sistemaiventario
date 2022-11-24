<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Parameter;

class ParameterController extends BaseController
{
    //
    public function search(Request $request)
    {
        
        if( !$request->has('parent') ) return $this->sendError('Se debe ingresar un tipo.');

        $parameters = Parameter::where( "parent" , "=" , $request->query('parent') );
        $parameters = $parameters->orderBy('id', 'asc')->get();
        return $this->sendResponse($parameters, 'List');
    }
}
