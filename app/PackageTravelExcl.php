<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTravelExcl extends Model
{
    protected $table = 'mt_travel_package_excl';

    protected $primaryKey = 'travelpackageexclid';

    protected $fillable = [
        'travelpackageid',
        'excludeText',
        'addBy',
        'editBy',
    ];

    public function packageTravel()
    {
        return $this->belongsTo(PackageTravel::class, 'travelpackageid', 'travelpackageid');
    }
}
