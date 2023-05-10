<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'emergency_contact'=>'required',
            'image' => 'required',
//

        ]);
        $validator['image'] = uploadImage($request->file('image'),'users');
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'msg'=>'error',
            ]);
        }
        $data=User::find($id);
        $data->update($request->all());
        if($data){
            return new UserResource($data);
        }
        return  response()->json([
            'status'=>400,
            'msg'=>'error',
        ]);

    }
}
