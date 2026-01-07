<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTravelDest extends Model
{
    protected $table = 'mt_travel_package_dest';

    protected $primaryKey = 'travelpackagedestid';

    protected $fillable = [
        'travelpackageid',
        'destinationid',
        'addBy',
        'editBy',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destinationid', 'destinationid');
    }

    public function packageTravel()
    {
        return $this->belongsTo(PackageTravel::class, 'travelpackageid', 'travelpackageid');
    }
}
