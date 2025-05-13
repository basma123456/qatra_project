<?php

namespace App\Http\Livewire\Admin\Menus;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class ShowMenu extends Component
{
    public $index, $item, $key, $sort;
    public $mySelected, $selectAll, $deleteId = '', $selected;

    public $search_title = "", $search_description = "", $search_status = "";

    protected $listeners = ['updatedSelectAll'];

    
    public function mount($item){
        $this->item = $item;
        $this->sort = $item->sort;
    }

    public function render()   {
        return view('livewire.admin.menus.show-menu');
    }




    // Events ----------------------------------------------
    public function update_status($id){
        Cache::forget('menus');
        Cache::forget('footer-menus');
        $this->item->status == 1 ? $this->item->status = 0 : $this->item->status = 1;
        $this->item->save();
        $this->emit('updateSession',  trans('message.admin.status_changed_sucessfully'));
    }

    public function update_featured($id){
        Cache::forget('menus');
        Cache::forget('footer-menus');
        $this->item->feature == 1 ? $this->item->feature = 0 : $this->item->feature = 1;
        $this->item->save();
        $this->emit('updateSession',  trans('message.admin.featured_changed_sucessfully'));
    }
    public function update_sort($id){
        Cache::forget('menus');
        Cache::forget('footer-menus');
        $this->item->sort  =  $this->sort;
        $this->item->save();
        $this->emit('updateSession',  trans('message.admin.sort_changed_sucessfully'));
    }

    public function deleteId($id){
        $this->emit('updateDeleteId', $id);
    }

    // Nested function ----------------------------------------------
    public function updateSellected($selected){
        $this->emit('updateSellected', $selected);
    }

    public function updatedSelectAll($selectes){
        $this->mySelected = $selectes;
    }

    
}
