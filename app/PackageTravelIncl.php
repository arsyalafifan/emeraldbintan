<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTravelIncl extends Model
{
     protected $table = 'mt_travel_package_incl';

    protected $primaryKey = 'travelpackageinclid';

    protected $fillable = [
        'travelpackageinclid',
        'travelpackageid',
        'includeText',
        'addBy',
        'editBy',
    ];

    public function packageTravel()
    {
        return $this->belongsTo(PackageTravel::class, 'travelpackageid', 'travelpackageid');
    }
}
