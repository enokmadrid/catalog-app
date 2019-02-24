<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Storage;

class DesignImage extends Model
{
     /**
     * An Image belongs to a Design
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designs() {
        return $this->belongsTo(Design::class);
    }


    /**
     * Store the image file
     *
     * @param $Img
     * @return string
     */
    public static function store($image): string {
        
        //Regular size image
        $imageName = time() . '-' . $image->getClientOriginalName();
        $imageFolder = 'images/';
        $imagePath = $imageFolder . $imageName;
        
        // Store image in AWS S3
        $image->storeAs($imageFolder, $imageName, 's3');

        // Thumbnail size image
        $thumbnail = Image::make($image)->resize(64, null, function($constraint){
            $constraint->aspectRatio();
        });
        $thumbnail = $thumbnail->stream()->detach();
        $thumbnailFolder = 'images/thumbnail/';
        $thumbnailPath = $thumbnailFolder . $imageName;

        // Store thumbnail in AWS S3, Used the Storage method because of image intervention
        Storage::disk('s3')->put($thumbnailPath, $thumbnail);

        return $imagePath;
    }
}
