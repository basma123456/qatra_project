<?php

namespace App\Http\Livewire;

use App\Models\CardDetail;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use ArPHP\I18N\Arabic;
use Illuminate\Support\Facades\Log;

class Card extends Component
{
    public $card;
    public $card_id = null;
    public $detail_id = null;
    public $x = null;
    public $y = null;
    public $text = null;
    public $color = "#1974D2";
    public $size = null;

    protected $listeners = ['changeColor' => 'setColor'];
 
    // public function mount()
    // {
    //     $this->color = "#1974D2";
    // }
    public function render()
    {
        $img = Image::make(storage_path("app/public/" . $this->card->img));
        foreach ($this->card->details as $item) {
            $arabic = new Arabic();
            $text = $arabic->utf8Glyphs(trim($item->text));
            $size = $item->size;
            $color = $item->color;
            $img->text($text, $item->x, $item->y, function ($font) use ($size, $color) {
                $font->file(public_path('fonts/Bahij_TheSansArabic-Bold.ttf'));
                $font->size($size);
                $font->color($color);
                $font->align('center');
            });
        }
        $file = "card_test_" . $this->card->id . '_' . time() . '.jpg';
        
        $img->save(public_path('files/' . $file));
        
        $pos = strpos(url(''),"public");
        // $img_url = url($pos);
        if($pos !== false){
            $img_url = url('files/' . $file);
        }else{
            $img_url = url('public/files/' . $file);
        }
        
        $this->dispatchBrowserEvent('contentChanged');
        return view('livewire.card', compact('img_url'));
    }

    function savedetail()
    {
        $row = [
            'card_id' => $this->card->id,
            'text' => $this->text,
            'x' => $this->x,
            'y' => $this->y,
            'color' => $this->color,
            'size' => $this->size,
        ];
        if (intval($this->detail_id) == 0) {
            $card_detail = CardDetail::create($row);
        } else {
            $card_detail = CardDetail::find($this->detail_id);
            $card_detail->update($row);
        }
        $this->detail_id = $card_detail->id;
        // $this->x = null;
        // $this->y = null;
        // $this->color = null;
        // $this->size = null;
        // $this->detail_id = null;
    }

    function edit($id)
    {
        $item = CardDetail::find($id);
        $this->text = $item->text;
        $this->x = $item->x;
        $this->y = $item->y;
        $this->color = $item->color;
        $this->size = $item->size;
        $this->detail_id = $item->id;
    }
    function delete($id)
    {
        $item = CardDetail::find($id);
        $item->delete();
    }
    function add()
    {
        $this->text = null;
        $this->x = null;
        $this->y = null;
        $this->color = null;
        $this->size = null;
        $this->detail_id = null;
    }

    function setColor($color){
        $this->color = $color;
    }
}
