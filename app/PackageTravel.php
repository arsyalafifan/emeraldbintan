<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTravel extends Model
{
    protected $table = 'mt_travel_package';

    protected $primaryKey = 'travelpackageid';

    protected $fillable = [
        'slug',
        'packageTitle',
        'packageDesc',
        'tourTimeFrom',
        'tourTimeTo',
        'price',
        'isPromo',
        'promoPrice',
        'isRibbon',
        'ribbonText',
        'addBy',
        'editBy',
    ];

    public function images()
    {
        return $this->hasMany(
            PackageTravelImg::class,
            'travelpackageid',
            'travelpackageid'
        );
    }

    public function packageDestinations()
    {
        return $this->hasMany(
            PackageTravelDest::class,
            'travelpackageid',
            'travelpackageid'
        );
    }

    // OPTIONAL (lebih enak dipakai)
    public function destinations()
    {
        return $this->hasManyThrough(
            Destination::class,
            PackageTravelDest::class,
            'travelpackageid',   // FK di PackageTravelDest
            'destinationid',     // PK di Destination
            'travelpackageid',   // PK di PackageTravel
            'destinationid'      // FK di PackageTravelDest
        );
    }

    public function prices()
    {
        return $this->hasMany(
            PackageTravelPrices::class,
            'travelpackageid',
            'travelpackageid'
        );
    }

    public function includes()
    {
        return $this->hasMany(
            PackageTravelIncl::class,
            'travelpackageid',
            'travelpackageid'
        );
    }

    public function excludes()
    {
        return $this->hasMany(
            PackageTravelExcl::class,
            'travelpackageid',
            'travelpackageid'
        );
    }

}
