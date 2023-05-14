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
        $id = auth('api')->user()->id;
        $data = User::find($id);
        $attributes = $request->validate([
            'name' => 'required',
            'emergency_contact' => 'required',
            'image' => 'file'
        ]);
        $image = $data->image;
        if (request()->file('image')) {
            $image = uploadImage($request->file('image'), 'patients');
        }

        $attributes['image'] = $image;

        $data->update($attributes);

        return new UserResource($data);



    }
}
