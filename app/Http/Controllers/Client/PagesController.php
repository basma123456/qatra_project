<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Settings\PagesSingleton;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public $page;
    public function __construct()
    {
        $this->page = PagesSingleton::getInstance();
    }

    public function show($slug)
    {
       $singlePage = $this->page->getPageBySlug($slug);
       return view('client.page' , compact('singlePage'));
    }
}
