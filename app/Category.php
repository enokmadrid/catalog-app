<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * A category has many designs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function designs() {
        return $this->belongsToMany(Design::class);
    }
}
