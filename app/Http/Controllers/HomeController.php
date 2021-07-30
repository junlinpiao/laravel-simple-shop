<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        if ($request->isMethod('post')) {
            $image = $request->file('image_file')->get();
            if ($image) {
                // $products = Product::all();
                // $searched_products = [];
                // foreach ($products as $product) {
                //     $img_file=file_get_contents($product->image_url);
                //     $md5image1 = md5($img_file);
                //     $md5image2 = md5($image);
                //     if ($md5image1 == $md5image2) {
                //         array_push($searched_products, $product);
                //     }
                // }
                $md5image2 = md5($image);
                $products_where = Product::where('image_md5_hash', $md5image2);
                $products_count = $products_where->count();
                $products = $products_where->paginate(12);
                return view('shop', ['products'=>$products, 'products_count'=>$products_count, 'pagination'=>true]);
            }
        } else {
            $search_keyword = $request->input('searchkey', '');
            if ($search_keyword == '') {
                $products_count = Product::count();
                $products = Product::paginate(12);
                return view('shop', ['products'=>$products, 'products_count'=>$products_count, 'pagination'=>true]);
            } else {
                
                $products_where = Product::where('name', 'like', '%'.$search_keyword.'%');
                $products_count = $products_where->count();
                $products = $products_where->paginate(12);
                return view('shop', ['products'=>$products, 'products_count'=>$products_count, 'searchkey'=>$search_keyword, 'pagination'=>true]);
            }
        }
    }

    public function search()
    {
        $products = Product::all();
        return view('shop', ['products'=>$products]);
    }
}
