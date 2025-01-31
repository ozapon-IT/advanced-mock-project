<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Shop;
use App\Models\Review;

class ReviewController extends Controller
{
    public function show(Shop $shop)
    {
        $review = Review::where('user_id', auth()->id())
            ->where('shop_id', $shop->id)
            ->first();

        return view('review', compact('shop', 'review'));
    }

    public function create(ReviewRequest $request, Shop $shop)
    {
        $validatedData = $request->validated();

        Review::create([
            'user_id' => auth()->id(),
            'shop_id' => $shop->id,
            'rating' => $validatedData['rating'],
            'title' => $validatedData['title'],
            'review' => $validatedData['review'],
        ]);

        return redirect()->route('show.mypage');
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

        return redirect()->route('show.mypage');
    }

    public function showReviewList(Shop $shop)
    {
        $reviews = Review::with('user')->where('shop_id', $shop->id)->paginate(5);

        return view('review-list', compact('reviews', 'shop'));
    }
}
