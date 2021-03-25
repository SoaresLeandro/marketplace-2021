<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;

class HomeController extends Controller
{
    private $product;
    private $store;

    public function __construct(Product $product, Store $store)
    {
        $this->product = $product;
        $this->store = $store;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->product->limit(6)->orderBY('id', 'DESC')->get();
        $stores = $this->store->limit(3)->get();
        
        return view('welcome', compact(['products', 'stores']));
    }

    public function productSingle($slug)
    {
        $product = $this->product->whereSlug($slug)->first();
        
        return view('product-single', compact(['product']));
    }
    
}