<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use App\Models\SettingsValues;

class SettingsController extends Controller
{
    use FileHandler;
    public function index(){
        $items = Settings::get();
        return view('admin.dashboard.settings.index',compact('items'));
    }

    public function form($key) {
        $settingMain = Settings::query()->where('key',$key)->get()->first();
        $settings = $settingMain->values;
        switch($key){
            case 'site_setting':
                return view('admin.dashboard.settings.form',compact('settings', 'settingMain'));

            case 'meta_setting':
                $settings = $settings->pluck('value', 'key')->toArray();
                return view('admin.dashboard.settings.partials.meta',compact('settings', 'settingMain'));

            default:
                return view('admin.dashboard.settings.form',compact('settings', 'settingMain'));

        }

    }

    public function form_update(Request $request, $id) {

        @$settings = Settings::findOrfail($id)->values;
        foreach ($request->except(['_token']) as $key=>$item){
            $settings = $settings->where('key',$key)->first();
            if ($request->hasFile($key)) {
                $filename = $this->upload_file($request->file($key) , ('settings'));
                $settings->where('key',$key)->update(['value'=>$filename ]);
            }else{
                $settings->where('key',$key)->update(['value'=>$item]);
            }
        }
        session()->flash('success' , trans('message.admin.updated_sucessfully') );
        return redirect()->back();
    }

    public function form_update_custom(Request $request, $key) {
        $settingMain = Settings::query()->where('key',$key)->get()->first();
        // store key in setting
        if($settingMain == null){
            $settingMain = Settings::create(['key'=> $key]);
        }
        $settings = $settingMain->values;
        // store values in setting
        $values = $request->except('_token');
        if($values){
            foreach($values as $key => $value){
                $set = $settings->where('key', $key)->first();
                if( $set == null){
                    SettingsValues::create(['key' => $key, 'value' => $value, 'setting_id' => $settingMain->id]);
                }
                else{
                    $set->update(['value' => $value]);
                }
            }
        }
        session()->flash('success' , trans('message.admin.updated_sucessfully') );
        return redirect()->back();
    }

}
