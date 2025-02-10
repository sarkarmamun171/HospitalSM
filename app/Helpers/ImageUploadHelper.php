<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ImageUploadHelper
{
    public static function uploadImage(Request $request, $fieldName, $path = 'uploads/doctors')
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            return $path . '/' . $imageName;
        }
        return null;
    }
}
