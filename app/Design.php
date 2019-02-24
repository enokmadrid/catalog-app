<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'number',
        'price',
        'image',
        'owner_id'
    ];


    /**
     * A design is owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo(User::class);
    }

    /**
     * A design belongs to many categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * A design has one image
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(DesignImage::class);
    }
}
