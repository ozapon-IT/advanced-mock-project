<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Shop;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(Shop $shop)
    {
        $reviews = Review::with('user')->where('shop_id', $shop->id)->paginate(5);

        return view('review-list', compact('reviews', 'shop'));
    }

    public function create(Shop $shop)
    {
        $review = Review::where('user_id', auth()->id())
            ->where('shop_id', $shop->id)
            ->first();

        return view('review', compact('shop', 'review'));
    }

    public function store(ReviewRequest $request, Shop $shop)
    {
        $validatedData = $request->validated();

        Review::create([
            'user_id' => auth()->id(),
            'shop_id' => $shop->id,
            'rating' => $validatedData['rating'],
            'title' => $validatedData['title'],
            'review' => $validatedData['review'],
        ]);

        return redirect()->route('mypage.index')->with(['success' => 'レビューを作成しました。']);
    }

    public function update(ReviewRequest $request, Shop $shop)
    {
        $validatedData = $request->validated();

        $review = Review::where('user_id', auth()->id())
            ->where('shop_id', $shop->id)
            ->first();

        if ($review) {
            $review->update($validatedData);
        }

        return redirect()->route('mypage.index')->with(['success' => 'レビューを更新しました。']);
    }
}
