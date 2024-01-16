<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', '0')->first();

        if ($product) {
            $product_id = $product->id;
            $review = Review::where('user_id', Auth::id())->where('prod_id', $product_id)->first();
            if ($review) {
                return view('frontend.reviews.edit', compact('review'));
            } else {

                $verified_purchase = Order::where('orders.user_id', Auth::id())
                    ->join('orders_item', 'orders.id', 'orders_item.order_id')
                    ->where('orders_item.prod_id', $product_id)->get();
                return view('frontend.reviews.index', compact('product', 'verified_purchase'));
            }
        } else {
            return redirect()->back()->with('status', "The link you followed was broken");
        }
    }

    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Product::where('id', $product_id)->where('status', '0')->first();
        if ($product_id) {
            $user_review = $request->input('user_review');
            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'user_review' => $user_review
            ]);
            $category_slug = $product->category->slug;
            $prod_slug = $product->slug;
            if ($new_review) {
                return redirect('category/' . $category_slug . '/' . $prod_slug)->with('status', "Thanks you for writing a review");
            }
        } else {
            return redirect()->back()->with('status', "The link you folowed was broken");
        }
    }
    public function edit($product_slug)
    {
        $product  = Product::where('slug', $product_slug)->where('status', '0')->first();
        if ($product) {
            $product_id = $product->id;
            $review = Review::where('user_id', Auth::id())->where('prod_id', $product_id)->first();
            if ($review) {
                return view('frontend.reviews.edit', compact('review'));
            } else {
                return redirect()->back()->with('status', "The link you folowed was broken");
            }
        } else {
            return redirect()->back()->with('status', "The link you folowed was broken");
        }
    }

    public function update(Request $request)
    {
        $user_review = $request->input('user_review');
        if ($user_review != '') {
            $review_id = $request->input('review_id');
            $review = Review::where('id', $review_id)->where('user_id', Auth::id())->first();
            if ($review) {
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('category/' . $review->product->category->slug . '/' . $review->product->slug)->with('status', "Review updated sussesfully");
            } else {
                return redirect()->back()->with('status', "The link you folowed was broken");
            }
        } else {
            return redirect()->back()->with('status', "you cannot submit an empty review");
        }
    }
}
