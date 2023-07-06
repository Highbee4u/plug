<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\UserRegistrationFormRequest;
use App\Http\Requests\Auth\UserLoginFormRequest;
use App\Http\Requests\Auth\SetPasscodeFormRequest;
use App\Http\Requests\Auth\BasicProfileUpdateFormRequest;
use App\Services\ReferralServices;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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

            
            if (! $token = auth('api')->attempt($credential)) {

                return $this->errorResponse('Unauthenticated', 401);
            }
    
            return $this->respondWithToken($token);
        }
        
    }

    public function set_passcode(SetPasscodeFormRequest $request)
    {
        if($request->validate()){
           
            $response = User::find(auth('api')->user()->id)->update(['passcode' => bcrypt($request['passcode'])]);

            return $response 
                    ? $this->showMessage('Passcode setup successfully', 200) 
                    : $this->errorResponse('Unable to set passcode, try again later', 409);

        }
        
    }
          
    public function basic_detail(BasicProfileUpdateFormRequest $request)
    {
            $response = User::find(auth('api')->user()->id)->update($request->validated());

            return $response 
                    ? $this->showMessage('Passcode setup successfully', 200) 
                    : $this->errorResponse('Unable to set passcode, try again later', 409);

    }
}
