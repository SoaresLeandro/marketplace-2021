<?php
namespace App\Traits;

// use Illuminate\Http\Request;

trait UploadTrait
{
    private function uploadPhoto($photos, $imageColumn = null)
    {
        $uploadedPhotos = [];
        
        if (is_array($photos)) {
            foreach ($photos as $photo) {
                $uploadedPhotos[] = [$imageColumn => $photo->store('products', 'public')];
            }
        } else {
            $uploadedPhotos = $photos->store('logo', 'public');
        }

        return $uploadedPhotos;
    }
}

