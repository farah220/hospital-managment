<?php

function uploadImage($image,$modelName) : string
{
    $path = "images/$modelName";
    $imageName = env('APP_NAME') . '_' .  time() . '_' .  $image->getClientOriginalName();
    $image->storeAs($path , $imageName ,'public');
    return $imageName;
}

if(!function_exists('getImagePath')){

    function getImagePath( $imageName = null , $defaultImage = 'default.jpg' , $folder = null ): string
    {
        $imagePath = public_path("/storage/images/$folder/$imageName");

        if ( $imageName && file_exists( $imagePath ) ) // check if the directory is null or the image doesn't exist
            return asset("/storage/images/$folder/$imageName");
        else
            return asset('placeholder_images/' . $defaultImage);

    }

}
