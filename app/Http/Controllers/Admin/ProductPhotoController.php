<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductPhoto;
use Storage;

class ProductPhotoController extends Controller
{
    public function photoRemove(Request $request)
    {
        $photoName = $request->get('photoName');

        if (Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);

            $removePhoto = ProductPhoto::where('image', $photoName);            
            $productId = $removePhoto->first()->product_id;

            $removePhoto->delete();
            
            flash("Foto removida com sucesso")->success();
            return redirect()->route('admin.products.edit', ['product' => (int)$productId]);
        }

    }
}
