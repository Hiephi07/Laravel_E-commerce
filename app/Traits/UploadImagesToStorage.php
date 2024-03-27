<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UploadImagesToStorage
{
    public function uploadImagesToStorage($request, $inputNameHTML, $folderName)
    {
        if ($request->hasFile($inputNameHTML)) {
            $file = $request->file($inputNameHTML);
            $nameRoot = $file->getClientOriginalName();
            $hashName = $file->hashName(); // Generate a unique, random name...
            $extension = $file->extension(); // Determine the file's extension based on the file's MIME type...
            $pathImage = $file->storeAs(
                "public/" . "$folderName/" . $request->user()->id,
                $hashName
            );
            return [
                "product_images" => $nameRoot,
                "image_path"     => $pathImage,
            ];
        }

        return null;
    }

    public function uploadMultipleImageToStorage($file, $folderName)
    {
        $nameRoot = $file->getClientOriginalName();
        $hashName = $file->hashName(); // Generate a unique, random name...
        $pathImage = $file->storeAs(
            "public/" . "$folderName/" . Auth::id(),
            $hashName
        );

        return [
            "pro_img_name" => $nameRoot,
            "pro_img_path" => $pathImage,
        ];
    }
}
