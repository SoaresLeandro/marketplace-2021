<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $userStore = auth()->user()->store;
        $products = [];
        
        if ($userStore) {            
            $products = $userStore->products()->paginate(4);
        }        
        
        return view('admin.products.index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Models\Category::all(['id', 'name']);

        return view('admin.products.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $store = auth()->user()->store;
        
        if (is_null($store)) {
            flash("Erro. Não há loja cadastrada para esse usuário.")->error();
            
            return redirect()->route('admin.products.create');
        }

        $categories = $request->get('categories', null);

        $product = $store->products()->create($data);
        
        $product->categories()->sync($categories);

        if ($request->hasFile('photos')) {
            $photos = $this->uploadPhoto($request->file('photos'), 'image');
            
            $product->photos()->createMany($photos);
        }

        flash('Produto criado com sucesso.')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);
        $categories = \App\Models\Category::all(['id', 'name']);
        
        return view('admin.products.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $product = $this->product->find($id);
        $categories = $request->get('categories', null);

        $product->update($data);

        if (!is_null($categories)) {
            $product->categories()->sync($categories);
        }        

        if ($request->hasFile('photos')) {
            $photos = $this->uploadPhoto($request->file('photos'), 'image');
            
            $product->photos()->createMany($photos);
        }

        flash('Produto atualizado com sucesso.')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        // $categoryProducts = CategoryProduct::where('product_id', $product->id)->get();
        
        // foreach ($categoryProducts as $categoryProduct) {
        //     dd($categoryProduct);
        // }
        
        $product->delete();

        flash('Produto removido com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

}
