<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTravelImg extends Model
{
    protected $table = 'mt_travel_package_img';

    protected $primaryKey = 'travelpackageimgid';

    protected $fillable = [
        'travelpackageid',
        'imgUrl',
        'imgDesc',
        'addBy',
        'editBy',
    ];

    public function packageTravel()
    {
        return $this->belongsTo(PackageTravel::class, 'travelpackageid', 'travelpackageid');
    }
    
}
