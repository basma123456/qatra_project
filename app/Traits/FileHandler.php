<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait FileHandler
{

    public function download_file($path = '', $title = '')
    {
        $arr = explode('.', $path);
        $mimetype = $arr[count($arr) - 1];
        return response()->download($path, $title . '.' . $mimetype);
    }

    public function upload_file($file, $path = '', $key = "")
    {
        $imageName = time() . $key . '.' . $file->extension();
        return "attachments" . "/" . $file->store($path, 'attachment');
    }

    public function saveFile($file, $path = '', $key = "")
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'pdf'];
        $extension = $file->extension();
        if (!in_array($extension, $allowedExtensions)) {
            return 'Invalid file type. Please upload an image or PDF.';
        }
        $imageName = time() . $key . '.' . $extension;
        $path = "attachments/" . $path;
        $image = $file->storeAs($path, $imageName, 'public');
        return $image;
    }


    public function delete_file($path = '')
    {
        File::delete($path);
    }

    public function delete_dir($path = '')
    {
        File::deleteDirectory($path);
    }

    public function loadArrayFromFile($path)
    {
        return File::getRequire($path);
    }

    public function CopyFileContent($src, $target)
    {
        if ($this->FileExists($src))
            File::copy($src, $target);
    }

    public function PutFileContent($path, $content)
    {
        File::put($path, $content);
    }

    public function GetFileContent($path)
    {
        return File::get($path);
    }

    public function FileExists($path)
    {
        return File::exists($path);
    }

    /***************basma*******************/
    function storeImage2($request, $path, $requestName, $name, $key = 0)
    {

        if ($request->hasfile($name)) {
            $file = $requestName;
            $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . $path, $newfile);
            return $newfile;
//        "/frontend/assets/img/management/"
        }
    }


    /*******************/

    function deleteImage($model, $name)
    {
        if (!(is_dir(public_path() . $model->path() . ($model->$name))) && file_exists(public_path() . $model->path() . ($model->$name))) {
            unlink(public_path() . $model->path() . ($model->$name));
        }
    }
    /***********************/

    /*******************/

    function deleteProductImages($model, $name)
    {
        if(is_array(json_decode($model->$name, true))) {
            foreach (json_decode($model->$name, true) as $key => $val) {
                !(is_dir('storage/' . $val)) && file_exists('storage/' . $val) ? unlink('storage/' . $val) : '';
            }
        }
    }
    /***********************/


    /*******************/
    function deleteUserImage($model, $name, $type)
    {
        if (!(is_dir(public_path() . $model->path($type) . ($model->$name))) && file_exists(public_path() . $model->path($type) . ($model->$name))) {
            unlink(public_path() . $model->path($type) . ($model->$name));
        }
    }

//    function deleteImageOfGallery($path, $model, $name )
//    {
//
//        if (file_exists(public_path() . $path . $model->$name ) && !is_dir(public_path() . $path . $model->$name )) {
//            unlink(public_path()  . $path . $model->$name);
//        }
//    }
    /***********************/
    function updateImage($request, $model, $path, $requestName, $name)
    {

        if (isset($requestName)) {

            if ($request->file($name)) {


                if ($request->file($name)) {
                    $file = $request->file($name);
                    $newfile = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . $path, $newfile);

                    if ($model->$name != null) {
                        if (@getimagesize((public_path() . $path . '/' . ($model->$name)))) {
                            unlink(public_path() . $path . '/' . ($model->$name));
                        }
                    }
                }
            }
        }
        return $newfile;


    }


    function updateImageMulti($request, $model, $id, $path, $requestName, $name)
    {

        $newfileAll = [];
        $idAll = [];
        if ($requestName) {
            foreach ($requestName as $key => $val) {
                if (isset($requestName[$key]) && isset($request->id[$key])) {

                    if (isset($request->file($name)[$key])) {

                        $managements = $model::where('id', (int)$request->id[$key])->first();

                        if (isset($request->file($name)[$key])) {
                            $file = $request->file($name)[$key];
                            $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path() . $path, $newfile);
                            $newfileAll[] = $newfile;
                            $idAll[] = $request->id[$key];

                            if ($managements->$name != null) {
                                if (@getimagesize((public_path() . $path . '/' . ($managements->$name)))) {
                                    unlink(public_path() . $path . '/' . ($managements->$name));
                                }
                            }
                        }
                    }
                }
            }
        }
        return [$newfileAll, $idAll];


    }


    /*************************/


    function storeImageMulti($request, $path, $requestName, $name)
    {
        $newfileAll = [];
        foreach ($requestName as $key => $val) {

            if (isset($requestName[$key])) {
                if (isset($request->file($name)[$key])) {
                    $file = $request->file($name)[$key];
                    $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . $path, $newfile);
                    $newfileAll[] = $newfile;
                }
            }
        }
        return $newfileAll;
    }
}
