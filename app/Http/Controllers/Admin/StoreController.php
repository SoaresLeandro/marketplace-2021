<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Storage;

class StoreController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {
        $store = auth()->user()->store;

        return view('admin.stores.index', compact(['store']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();        
        
        if ($request->hasFile('logo')) {

            $data['logo'] = $this->uploadPhoto($request->file('logo'));
            
        }

        $store = $user->store()->create($data);

        flash('Loja criada com sucesso.')->success();
        return redirect()->route('admin.stores.index');
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
        $store = Store::find($id);
        $users = \App\Models\User::all(['id', 'name']);

        return view('admin.stores.edit', compact(['store', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $store = Store::find($id);
        $data = $request->all();
        
        if ($request->hasFile('logo')) {

            if (Storage::disk('public')->exists($store->logo)) {

                Storage::disk('public')->delete($store->logo);

            }

            $data['logo'] = $this->uploadPhoto($request->file('logo'));
        }

        $store->update($data);

        flash('Loja atualizada com sucesso.')->success();
        return redirect()->route('admin.stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);

        $store->delete();

        flash('Loja removida com sucesso.')->success();
        return redirect()->route('admin.stores.index');
    }

}
