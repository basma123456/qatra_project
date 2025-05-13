<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReviewRequest;
use App\Models\Review;
use App\Traits\FileHandler;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use FileHandler;

    protected $review;

    public function __construct()
    {
        $this->review = new Review();
    }


    public function index()
    {
        $query = Review::query()->orderBy('sort', 'ASC');
        if (request()->input('name') != '') {
            $query = $query->where('name', "like", '%' . request()->input('name') . '%');
        }
        if (request()->input('active') != '') {
            $query = $query->where('active', request()->input('active'));
        }
        if (request()->input('feature') != '') {
            $query = $query->where('feature', request()->input('feature'));
        }

        $items = $query->paginate($this->pagination_count);

        return view('admin.dashboard.reviews.index', compact('items'));
    }

    public function create()
    {
        return view('admin.dashboard.reviews.create');
    }


    public function store(ReviewRequest $request)
    {
        $data = $request->getSanitized();
        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage2($request, $this->review->path(), $request->image, 'image');
        }
        Review::create($data);
        session()->flash('success', "لقد ادخلت هذة الصفحة بنجاح");
        return back();
    }


    public function show(Review $review)
    {
        return view('admin.dashboard.reviews.show', compact('review'));
    }


    public function edit(Review $review)
    {
        return view('admin.dashboard.reviews.edit', compact('review'));
    }


    public function update(ReviewRequest $request, Review $review)
    {
        $data = $request->getSanitized();
        if ($request->hasFile('image')) {
            $data['image'] = $this->updateImage($request, $review, $this->review->path(), $request->image, 'image');
        }
        $review->update($data);
        session()->flash('success', "لقد قمت بتعدل هذة الصفحة بنجاح");
        return redirect()->back();
    }


    public function destroy(Review $review)
    {

        $this->deleteImage($review, 'image');
        $review->delete();
        session()->flash('success', trans('message.admin.deleted_sucessfully'));
        return redirect()->back();
    }


    public function update_status($id)
    {
        $review = Review::findOrfail($id);
        $review->status == 1 ? $review->status = 0 : $review->status = 1;
        $review->save();
        return redirect()->back();
    }

    public function update_feature($id)
    {
        $review = Review::findOrfail($id);
        $review->feature == 1 ? $review->feature = 0 : $review->feature = 1;
        $review->save();
        return redirect()->back();
    }


    public function actions(Request $request)
    {
        if ($request['publish'] == 1) {
            $reviews = Review::findMany($request['record']);
            foreach ($reviews as $review) {
                $review->update(['status' => 1]);
            }
            session()->flash('success', trans('reviews.status_changed_sucessfully'));
        }
        if ($request['unpublish'] == 1) {
            $reviews = Review::findMany($request['record']);
            foreach ($reviews as $review) {
                $review->update(['status' => 0]);
            }
            session()->flash('success', trans('reviews.status_changed_sucessfully'));
        }
        if ($request['delete_all'] == 1) {
            $reviews = Review::findMany($request['record']);
            foreach ($reviews as $review) {
                $this->deleteImage($review, 'image');
                $review->delete();
            }
            session()->flash('success', trans('reviews.delete_all_sucessfully'));
        }
        return redirect()->back();
    }

}
