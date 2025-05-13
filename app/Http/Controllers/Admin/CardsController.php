<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::paginate(20);
        return view("admin.cards.index", compact("cards"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cards.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'img' => "required|image"
        ]);

        $row = [
            'text' => $request->text,
            'img' => UploadFile::store($request->img)
        ];
        $row['is_payment'] = ($request->is_payment) ? 1 : 0;
        $row['is_gift'] = ($request->is_gift) ? 1 : 0;
        $row['status'] = ($request->status) ? 1 : 0;

        Card::create($row);
        return redirect()->route("admin.cards.index");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        return view("admin.cards.edit", compact("card"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $request->validate([
            'img' => "image"
        ]);

        $row = [
            'text' => $request->text,
        ];
        if ($request->img) {
            Storage::disk('public')->delete($card->img);
            $row['img'] = UploadFile::store($request->img);
        }
        $row['is_payment'] = ($request->is_payment) ? 1 : 0;
        $row['is_gift'] = ($request->is_gift) ? 1 : 0;
        $row['status'] = ($request->status) ? 1 : 0;

        $card->update($row);
        return redirect()->route("admin.cards.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        // @unlink(storage_path('app/public/'.$card->img));
        Storage::disk('public')->delete($card->img);
        $card->delete();
        return redirect()->route("admin.cards.index");
    }

    public function detail_create(CardDetail $detail)
    {
        //
    }
    public function detail_delete(CardDetail $detail)
    {
        //
    }
}
