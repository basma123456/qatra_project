<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $msg_type, $statistics;
    public $message = false;
    public $mySelected = [], $selectAll = false, $deleteId = '', $pagination_count = 25;

    //searchfilters
    public $search_name = "", $search_email = "", $search_mobile = "", $search_identifier = "",
        $search_source = "", $search_payment_id = "", $search_total_from = 0, $search_total_to = 0,
        $search_status_id = "", $search_status = "", $search_refer,
        $search_price_from, $search_price_to, $search_created_from, $search_created_to;

    public $paymentMethods, $refers;

    public $items, $item, $orderStatus, $selectOrderStatus = "";

    protected $listeners = ['updateSellected', 'updateSession'];


    public function mount()
    {
        $this->orderStatus = OrderStatus::get();
        $this->paymentMethods = PaymentType::get();
    }

    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        session()->flash('success', trans('message.admin.deleted_sucessfully'));
    }

    public function filters()
    {
        $this->alert("clear search filtrats", 'info');
    }

    function alert($message, $type = '')
    {
        $this->message = $message;
        empty($type) ? $this->msg_type = "info" : $this->msg_type = $type;
    }

    /**
     * reset the variables that needs to be reset after request
     *
     * @return void
     */
    function dehydrate()
    {
        $this->message = false;
    }
    // Events All Selected ----------------------------------------------
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->mySelected = $this->items->pluck('id')->toArray();
        } else {
            $this->mySelected = [];
        }
        $this->emit('updatedSelectAll', $this->mySelected);
    }

    public function publishSelected()
    {
        $orders = Order::findMany($this->mySelected);

        foreach ($orders as $order) {
            $order->order_status_id = 100;
            $order->save();
            // event(new OrderConfirmationEvent($order));
        }
        session()->flash('success', trans('message.admin.status_changed_sucessfully'));
        $this->clearSelect();
        $this->emit('updatedSelectAll', $this->mySelected);
    }

    public function unpublishSelected()
    {
        $orders = Order::findMany($this->mySelected);
        foreach ($orders as $order) {
            $order->order_status_id = 301;
            $order->save();
        }
        session()->flash('success', trans('message.admin.status_changed_sucessfully'));
        $this->clearSelect();
        $this->emit('updatedSelectAll', $this->mySelected);
    }

    public function cancelSelected()
    {
        $orders = Order::findMany($this->mySelected);
        foreach ($orders as $order) {
            $order->order_status_id = 404;
            $order->save();
        }
        session()->flash('success', trans('message.admin.status_changed_sucessfully'));
        $this->clearSelect();
        $this->emit('updatedSelectAll', $this->mySelected);
    }
    public function deleteSelected()
    {
        $items = Order::findMany($this->mySelected);
        foreach ($items as $item) {
            $item->delete();
        }
        session()->flash('success', trans('message.admin.delete_all_sucessfully'));
        $this->clearSelect();
        $this->emit('updatedSelectAll', $this->mySelected);
    }
    public function updatedSelectOrderStatus($val)
    {
        $items = Order::findMany($this->mySelected);
        foreach ($items as $item) {
            $item->status_id = $val;
            $item->save();
        }
        $this->clearSelect();
        $this->selectOrderStatus = "";
        session()->flash('success', trans('message.admin.status_changed_sucessfully'));
        $this->emit('updatedSelectAll', $this->mySelected);
    }

    public function clearSelect()
    {
        $this->selectAll = false;
        $this->mySelected = [];
        $this->emit('updatedSelectAll', $this->mySelected);
    }

    public function updateSellected($selected)
    {
        if (in_array(@$selected, @$this->mySelected)) {
            $this->mySelected = array_diff($this->mySelected, [$selected]);
        } else {
            array_push($this->mySelected, $selected);
        }
        if (count($this->mySelected) == $this->pagination_count) $this->selectAll = true;
        else $this->selectAll = false;
        $this->emit('AllupdatedSelect', $this->selectAll);
    }

    public function updateDeleteId($id)
    {
        $this->deleteId = $id;
    }
    
    public function updateSession($msg)
    {
        session()->flash('success', $msg);
    }

    public function clearSearch()
    {
        $this->search_identifier = $this->search_name =  $this->search_mobile =  $this->search_email =
        $this->search_status = $this->search_price_from = $this->search_price_to =
        $this->search_created_from = $this->search_created_to = $this->search_email = $this->search_mobile = $this->search_identifier =
        $this->search_source = $this->search_payment_id = "";
    }

    public function render()
    {
        if(request()->get('customer_mobile') &&  is_string(request()->get('customer_mobile'))) {
            $user_id = User::where('mobile' , request()->get('customer_mobile'))->value('id');
            $query = order::orderBy('created_at', 'DESC')->where('user_id' , $user_id);
        }else{
            $query = order::orderBy('created_at', 'DESC');
        }


        // Filter
        $filters = [
            'id' => $this->search_identifier,
            'payment_type_id' => $this->search_payment_id,
            'order_status_id' => $this->search_status,
        ];

        foreach ($filters as $key => $value) {
            if (!empty($value)) $query->where($key, 'like', '%' . $value . '%');
        }

        if ($this->search_name  != '') {
            $query = $query->whereHas('user', function($q){
                $q->where('name', 'like', '%' . $this->search_name . '%');
            });
            $this->resetPage();
        }
        if ($this->search_mobile  != '') {
            $query = $query->whereHas('user', function($q){
                $q->where('mobile', 'like', '%' . $this->search_mobile . '%');
            });
            $this->resetPage();
        }
        if ($this->search_email  != '') {
            $query = $query->whereHas('user', function($q){
                $q->where('email', 'like', '%' . $this->search_email . '%');
            });
            $this->resetPage();
        }
        if ($this->search_created_from  != '') {
            $query = $query->whereDate('created_at', '>=', $this->search_created_from);
            $this->resetPage();
        }
        if ($this->search_created_to  != '') {
            $query = $query->whereDate('created_at', '<=', $this->search_created_to);
            $this->resetPage();
        }
        if ($this->search_price_from  != '') {
            $query = $query->where('total', '>=',  $this->search_price_from);
            $this->resetPage();
        }
        if ($this->search_price_to  != '') {
            $query = $query->where('total', '<=',  $this->search_price_to);
            $this->resetPage();
        }

        $this->statistics['finished'] = (clone($query))->where('order_status_id', '100')->count();
        $this->statistics['transfer'] = (clone($query))->where('order_status_id', '202')->count();
        $this->statistics['all'] = (clone($query))->where('order_status_id', '!=', '201')->count();
        $this->statistics['waiting'] = (clone($query))->where('order_status_id', '301')->count();

        $links = $this->items = clone($query)->paginate($this->pagination_count);
        $items = $this->items = collect($this->items->items());

        // select all empty when change page
        if (!array_intersect(@$this->items->pluck('id')->toArray(), @$this->mySelected) && @$this->mySelected != []) {
            $this->selectAll = false;
            $this->mySelected = [];
        }
        return view('livewire.admin.orders.index', compact('links', 'items'));
    }
}
