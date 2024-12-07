<?php
namespace App\Services;

class FileUploadService
{


    public static function fileUpload($file, $path)
    {

        $fileName = null;
        //check file exist
        if ($file) {

            //file name generate
            $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();

            //file store where i want to 
            $file->storeAs($path, $fileName);
        }
        return $fileName;
    }
}
