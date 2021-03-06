<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        
        return view('cart', compact(['cart']));
    }

    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product = \App\Models\Product::whereSlug($productData['slug']);

        if (!$product->count() || $productData['amount'] == 0) {
            return redirect()->route('product.single', ['slug' => $productData['slug']]);
        }

        $product = $product->first(['name', 'price'])->toArray();

        $product = array_merge($productData, $product);
        
        if (session()->has('cart')) {

            $products = session()->get('cart');
            $productsSlug = array_column($products, 'slug');
            
            if (in_array($product['slug'], $productsSlug)) {
                
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                
                session()->put('cart', $products);
                
            } else {

                session()->push('cart', $product);

            }
        } else {
            $products[] = $product;

            session()->put('cart', $products);
        }

        flash('Produto adicionado ao carrinho')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart.index');
        } 

        $products = session()->get('cart');

        $products = array_filter($products, function ($line) use ($slug) {
            return ($line['slug'] != $slug);
        });

        session()->put('cart', $products);
        
        flash('Item removido do carrinho')->warning();
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');

        flash('Compra cancelada com sucesso.')->success();
        return redirect()->route('cart.index');
    }

    public function productIncrement($slug, $amount, $products)
    {
        $products = array_map( function ($line) use ($slug, $amount) {

            if ($slug == $line['slug']) {

                $line['amount'] += $amount;

            }

            return $line;

        }, $products);
        
        return $products;
    }
}
