<?php

namespace App\Http\Controllers\Api\Liscence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Liscence;
use App\Http\Resources\User\LiscenceResource;

class LiscenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liscence_detail = auth('api')->user()->License;
        return $liscence_detail
                ? $this->successResponse(['liscence_detail' => new LiscenceResource($liscence_detail)], 'Liscence Detail', 200)
                : $this->errorResponse('You have no liscence detail', 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLiscenceFormRequest $request)
    {
        if(auth('api')->user()->License){
            return $this->errorResponse('You already added your Liscence', 422);
        }
        
        $data = array_merge($request->validated(), ['user_id' => auth('api')->user()->id ]);

        return $liscence_detail = Liscence::create($data)
                ? $this->successResponse(['liscence_detail' => new LiscenceResource($liscence_detail)], 'Liscence Detail', 200)
                : $this->errorresponse('Unable to create Liscence');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $liscence_detail = Liscence::find($id);

        return $liscence_detail 
                ?   $this->successResponse(['liscence_detail' => $liscence_detail], 'Liscence Detail', 200)
                :   $this->errorResponse('No record match the id supplied', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $liscence_detail = Liscence::find($id);

        if($liscence_detail){
            $liscence_detail->update($request->validated());

            return $this->showMessage('Liscence Detail Updated Successfully', 200);
        }else{
            return $this->errorResponse('Liscence ID supplied does not match any record', 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Liscence::where('id', $id)->exist()){

            return Liscence::where('id', $id)->delete() 
                    ? $this->showMessage('Liscence Detail Deleted Successfully', 200)
                    : $this->errorResponse('Unable to delete liscence record, try again later', 422);
        }else{
            return $this->errorresponse('Liscence ID supply doesn\'t match any record', 404);
        }
    }
}
