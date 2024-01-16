<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featured_products = Product::where('trending', '1')->take(15)->get();
        $trending_category = Category::where('popular', '1')->take(15)->get();
        return view('frontend.index', compact('featured_products', 'trending_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function category()
    {
        $category = Category::where('status', '0')->get();
        return view('frontend.category', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function viewcategory($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cate_id', $category->id)->where('status', '0')->get();
            return view('frontend.products.index', compact('category', 'products'));
        } else {
            return redirect('/')->with('status', "Slug doesnot exists");
        }
    }

    /**
     * Display the specified resource.
     */
    public function productview($cate_slug, $prod_slug)
    {
        if (Category::where('slug', $cate_slug)->exists()) {
            if (Product::where('slug', $prod_slug)->exists()) {
                $products = Product::where('slug', $prod_slug)->first();
                $ratings = Rating::where('prod_id', $products->id)->get();
                $rating_sum = Rating::where('prod_id', $products->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id', $products->id)->where('user_id', Auth::id())->first();
                $reviews = Review::where('prod_id', $products->id)->get();
                if ($ratings->count() > 0) {
                    $rating_value = $rating_sum / $ratings->count();
                } else {
                    $rating_value = 0;
                }
                return view('frontend.products.view', compact('products', 'ratings', 'rating_value', 'user_rating', 'reviews'));
            } else {
                return redirect('/')->with('status', "The link was broken");
            }
        } else {
            return redirect('/')->with('status', "No such category exists");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function productlistAjax()
    {
        $products = Product::select('name')->where('status', '0')->get();
        $data = [];

        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }

    public function searchProduct(Request $request)
    {
        $searched_product = $request->product_name;

        if ($searched_product != "") {
            $product = Product::where("name", "like", "%$searched_product%")->first();
            //dd($product);
            if ($product) {
                return redirect('category/' . $product->category->slug . '/' . $product->slug);
            } else {
                return redirect()->back()->with("status", "No product matched your search");
            }
        } else {
            return redirect()->back();
        }
    }
}
