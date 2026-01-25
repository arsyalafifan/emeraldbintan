<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = 'mt_gallery_travel';
    

    protected $fillable = [
        'travel_packages_id', 'image', 'gallery_name'
    ];

    protected $hidden = [

    ];
}
