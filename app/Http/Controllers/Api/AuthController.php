<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Parameter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthController extends BaseController
{
    //

    /**
     * Registro de usuario
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'gpid' => 'required|integer|min:8|digits_between: 8,9',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gpid' => $request->gpid,
            'role_id' => Role::User,
            'is_active' => Parameter::StatusActive,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gpid' => 'required|integer|min:8|digits_between: 8,9',
            'password' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if(Auth::attempt(['gpid' => $request->gpid, 'password' => $request->password])){

            $_user = Auth::user(); 
            //var_dump($_user);
            $user = User::find( $_user->id );
            $tokenResult = $user->createToken('Laravel Password Grant Client');
            // var_dump($tokenResult);
            $token = $tokenResult->accessToken;
            $expiration = $tokenResult->token->expires_at->diffInSeconds(Carbon::now());
            
            // $token->expires_at = Carbon::now()->addHours(4);
            // if ($request->remember_me)
            //     $token->expires_at = Carbon::now()->addHours(4);

            $success = array(
                'token' => $token,
                'token_type' => "Bearer",
                'expires_at' => $expiration
            );
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Usuario y Contrase??a incorrectas.', ['error'=>'Usuario y Contrase??a incorrectas']);
        } 
    }

    /**
     * Cierre de sesi??n (anular el token)
     */
    public function logout()
    {
        $token = Auth::user()->token();

        /* --------------------------- revoke access token -------------------------- */
        $token->revoke();
        $token->delete();

        /* -------------------------- revoke refresh token -------------------------- */
        // $refreshTokenRepository = app(RefreshTokenRepository::class);
        // $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);

        return $this->sendResponse(array(), 'Successfully logged out.');
        
    }

    /**
     * Obtener el objeto User como json
     */
    public function me()
    {
        $_user = Auth::user(); 
        $user = User::find( $_user->id );
        return $this->sendResponse( $user , 'Successfully.');
    }
}
