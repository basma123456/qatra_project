<?php
namespace App\Settings;

use App\Models\Marketer;

class MarketersSingleton
{
    private static $marketerInstance;
    private $marketer;

    private function __construct()
    {
        $this->marketer =  new Marketer();
// Private constructor to prevent instantiation outside the class
    }

    public static function getInstance()
    {
        if (!isset(self::$marketerInstance)) {
            self::$marketerInstance = new self;
        }

        return self::$marketerInstance;
    }

    public function getMarketers()
    {
        if(auth()->check()) {
            return $this->marketer->get();
        }else{
            toastr()->error('you have no access to this permission');
        }
    }

    public function getMarketersByMarketerAdmin($marketerAdminId)
    {
        return $this->marketer->where('marketer_admin_id' , $marketerAdminId)->with('orders')->withSum('orders' , 'total')->latest()->get();
    }


//    public function getMarketersNames()
//    {
//        return $this->marketer->pluck('slug' , 'title');
//    }


}
