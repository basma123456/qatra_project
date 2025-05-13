<?php
namespace App\Settings;

use App\Models\Pages;

class PagesSingleton
{
    private static $pageInstance;
    private $page;

    private function __construct()
    {
        $this->page =  new Pages();
// Private constructor to prevent instantiation outside the class
    }

    public static function getInstance()
    {
        if (!isset(self::$pageInstance)) {
            self::$pageInstance = new self;
        }

        return self::$pageInstance;
    }

    public function getPages()
    {
        return $this->page->get();
    }

    public function getPagesNames()
    {
        return $this->page->active()->pluck('slug' , 'title');
    }

    public function getPageBySlug($slug)
    {
        return $this->page->where('slug' , $slug)->first();
    }
}
