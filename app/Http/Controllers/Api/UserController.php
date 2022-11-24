<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Parameter;

class UserController extends BaseController
{
    //
    /**
     * Registro de usuario
     */
    public function findAll()
    {
        $users = User::where( "role_id" , "=" , 2 )
        ->orderBy('created_at', 'desc')
            ->get();
        return $this->sendResponse($users, 'List');
    }

    public function create(UserCreateRequest $request)
    {
        try {

            $data = (object) $request->all();
            
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt( $data->password ),
                'role_id' => Role::User,
                'is_active' => 1
            ]);

            return $this->sendResponse($user->id, 'List');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
        
    }

    public function edit($id)
    {
        try {

            $user = User::find($id);
            
            return $this->sendResponse($user, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function update( UserUpdateRequest $request, $id )
    {
        try {
            $currentUser = User::find($id);
            if( $currentUser == null ) return $this->sendError('Usuario no existe');
            $data = (object) $request->all();
            $update = array(
                "name" => $data->name,
                'email' => $data->email,
            );

            if( $data->password != null ){
                if( $data->password_confirmation == null ) return $this->sendError('El campo confirmar contraseña es obligatorio.');
                if( $data->password_confirmation != $data->password ) return $this->sendError('El campo confirmar contraseña debe ser igual al de contraseña.');
                $update["password"] = bcrypt( $data->password );
            }

            $user = User::where('id', $id)->update($update);
            
            return $this->sendResponse($user, 'Edit');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }

    public function updateStatus( Request $request , $id)
    {
        try {
            $currentUser = User::find($id);
            if( $currentUser == null ) return $this->sendError('Usuaio no existe');

            $validator = Validator::make($request->all(),[
                'status' => 'required|boolean',
            ]); 
    
            if($validator->fails()) {          
                return $this->sendError('Error Validacion', ['error'=> $validator->errors() ]);
            }

            $data = (object) $request->all();

            $update = array(
                "is_active" => $data->status ? Parameter::StatusActive : Parameter::StatusInactivective,
            );

            $user = User::where('id', $id)->update($update);
            
            return $this->sendResponse($user, 'Cambio estado');

        } catch (\Throwable $th) {
            return $this->sendError('Hubo un error.');
        }
    }
}
