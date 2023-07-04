<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Resources\Account\AccountResource;
use App\Http\Requests\Account\CreateBankAccountFormRequest;
use App\Http\Requests\Account\UpdateBankAccountFormRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account_detail = Account::where('user_id', auth('api')->user()->id)->first();
        return $account_detail 
                ? $this->successResponse(['account_detail' => new AccountResource($account_detail)], 'Account Detail', 200)
                : $this->errorResponse('You have no account yet', 404);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function create(CreateBankAccountFormRequest $request)
    {
        if(auth('api')->user()->Account){
            return $this->errorResponse('You Already have an account, delete the previous account to add new record', 422);
        }

        $data = array_merge($request->validated(),['user_id' => auth('api')->user()->id ]);

        $account_detail = Account::create($data);

        return $account_detail 
                ? $this->successResponse(['account_detail' => new AccountResource($account_detail)], 'Account Detail', 200)
                : $this->errorResponse('Unable to create account, try again later', 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account_detail = Account::find($id);
        return $account_detail 
                ? $this->successResponse(['account_detail' => new AccountResource($account_detail)], 'Account Detail', 200)
                : $this->errorResponse('Account ID supply doesn\'t match any record', 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankAccountFormRequest $request, string $id)
    {
        if(Account::where('id', $id)->exist()){
            
            return Account::where('id', $id)->update($request->validated()) 
                    ? $this->successResponse(['account_detail' => new AccountResource(Account::where('id', $id)->first())], 'Account Detail Successfully Updated', 200)
                    : $this->errorResponse('Account ID supply doesn\'t match any record', 404);

        }else{
            return $this->errorresponse('Account ID supply doesn\'t match any record', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Account::where('id', $id)->exist()){

            return Account::where('id', $id)->delete() 
                    ? $this->showMessage('Account Detail Deleted Successfully', 200)
                    : $this->errorResponse('Unable to delete account, try again later', 422);
        }else{
            return $this->errorresponse('Account ID supply doesn\'t match any record', 404);
        }
    }
}
