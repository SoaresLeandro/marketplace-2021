<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;

class HomeController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->product->limit(8)->orderBY('id', 'DESC')->get();
        
        return view('welcome', compact(['products']));
    }

    public function productSingle($slug)
    {
        $product = $this->product->whereSlug($slug)->first();
        
        return view('product-single', compact(['product']));
    }
}