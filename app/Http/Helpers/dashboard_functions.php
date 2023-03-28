<?php

function uploadImage($image,$modelName) : string
{
    $path = "images/$modelName";
    $imageName = env('APP_NAME') . '_' .  time() . '_' .  $image->getClientOriginalName();
    $image->storeAs($path , $imageName ,'public');
    return $imageName;
}
