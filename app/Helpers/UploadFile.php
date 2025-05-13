<?php

namespace App\Helpers;

use App\Models\Category;
use App\Settings\SettingSingleton;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadFile
{
    static public function store($uploadedFile, $path = 'public', $assignNewName = true, $fileSystem = 'custom')
    {
        // $uploadedFile = Request::
        if ($assignNewName) {
            $extension = $uploadedFile->getClientOriginalExtension();
            $fileName  = sprintf('%s.%s', md5(strtotime(now()) . rand(1000, 9999)), $extension);
        } else {
            $fileName = $uploadedFile->getClientOriginalName();
        }
        try {
            $uploadedFile->storeAs(
                $path,
                $fileName
            );
            $extension = strtolower($extension);
            if (in_array($extension, ['jpg', 'png', 'jpeg'])) {
                $img = Image::make(storage_path("app/public/" . $fileName))->orientate();
                $img->resize(900, null, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                });
                // $img->fit(900, 1200, function ($constraint) {
                //     $constraint->upsize();
                // });
                // $img->resize(900,1200);
                $img->save(storage_path("app/public/" . $fileName), 75);
            }
            return $fileName;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }










}





/*******************remove html tags**********/
if (!function_exists('removeHTML')) {
// update deprecated one
    function removeHTML($content)
    {
        $result = htmlspecialchars_decode(strip_tags($content));
        $result = trim($result);
        $result = str_replace('&nbsp;', '', $result);
        return $result;
    }
}



if (!function_exists('slug2')) {
    function slug2($value)
    {

        if (is_null($value)) {
            return "";
        }
        $value = trim($value, " ");
        $value = mb_strtolower($value, "UTF-8");;
        $value = preg_replace('/\s+/', ' ', $value);
        $value = str_replace("/", '-', $value);
        $value = str_replace(" ", '-', $value);
        return $value;
    }
}



if (!function_exists('categories')) {
    function categories()
    {


        $cats = Category::active()->feature()->select('name_ar' , 'slug')->orderBy('sort' , 'ASC')->get();
        return $cats;
    }
}



if (!function_exists('arrang_records')) {
    function arrang_records($items, $search_ids = [])
    {
        $ids = [];
        if ($search_ids != []) $parents = $items->whereIn('id', $search_ids);
        else $parents = $items->where('parent_id', null);
        foreach ($parents as $item) {
            $ids[] = $item->id;
            arrange_child($item, $ids, $items);
        }
        return $ids;
    }
}


if (!function_exists('arrange_child')) {
    function arrange_child($parent, &$ids, $items = null)
    {
        $children =  $items->where('parent_id', $parent->id);
        foreach ($children as $item) {
            $ids[] = $item->id;
            arrange_child($item, $ids, $items);
        }
    }
}





if (!function_exists('pagination_count')) {
    function pagination_count()
    {
        return 10;
    }
}


if (!function_exists('getIcon')) {
    function getIcon()
    {
      return  Storage::url(SettingSingleton::getInstance()->getItem('logo_ar'));
    }
}

if (!function_exists('getImage')) {
    function getImage($name)
    {
        return  Storage::url($name);
    }
}







