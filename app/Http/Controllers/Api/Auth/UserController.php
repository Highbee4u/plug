<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\UserRegistrationFormRequest;
use App\Http\Requests\Auth\UserLoginFormRequest;
use App\Services\ReferralServices;

class UserController extends Controller
{
    public function register(UserRegistrationFormRequest $request){
        
        try{

            DB::beginTransaction(); 
            
                $user = User::create($request->validated());
                
                if($user){
                    $user->referal_code = (new ReferralServices())->generate_Code($user->id);
                    $user->save();
                }

            DB::commit();


            return $user
                ? $this->showMessage('Registration Successfull, proceed to login and complete your profile', 200)
                : $this->errorResponse('Error occur, try again later', 400);

        }catch(\Exception $exp) {
                DB::rollBack(); 
                return $this->errorResponse($exp->getMessage(), 400);
        }
    }

    public function login(UserLoginFormRequest $request){
        
        if($request->validated()){
            
            $credential = ['phone_number' => $request['phone_number'] , 'password' => $request['password'] ];

            $user = User::where('phone_number', $request['phone_number'])->first();

            if($user->is_dissabled == 1){
                return $this->errorResponse('Your account has been dissable, call support to activate', 401);
            }

            if($user->recovery_mode == 1){
                return $this->errorResponse('Your account has been set to recovery mode, call support to re-activate', 401);
            }
            
            if (! $token = auth('api')->attempt($credential)) {
                
                if($user->login_attempt == 3){

                    $user->recovery_mode = 1;

                    $user->save();
                    
                    return $this->errorResponse('Your account has been set to recovery mode, call support to re-activate', 401);
                }

                $user->login_attempt += 1;

                $user->save();

                return $this->errorResponse('Unauthenticated, '.(3 - $user->login_attempt == 0 ? 'last attempt and your account would be blocked' : 'You have '.(3 - $user->login_attempt.' left')), 401);
            }
    
            $user->last_login = \Carbon\Carbon::now(); 

            $user->login_attempt = 0; // reset attemp on successful login

            $user->save();

            return $this->respondWithToken($token);
        }
        
    }
}
