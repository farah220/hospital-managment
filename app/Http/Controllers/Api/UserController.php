<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        if (auth('api')->check()){
        $id = auth('api')->user()->id;
        $data = User::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'emergency_contact' => 'required',
        ]);
        $image = $data->image;
        if (request()->file('image')) {
            $image = uploadImage($request->file('image'), 'patients');
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'msg' => 'error',
            ]);
        }

        $data->update([$validator, 'image' => $image]);
        if (isset($data)) {
            return new UserResource($data);
        }
        return response()->json([
            'status' => 400,
            'msg' => 'error',
        ]);
    }

    return response()->json([
'status' => false,
'errNum' => '401',
'message' => 'Unauthorized',
]);
    }
}
