<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTravelPrices extends Model
{
    protected $table = 'mt_travel_package_prices';

    protected $primaryKey = 'travelpackagepriceid';

    protected $fillable = [
        'travelpackageid',
        'priceSeq',
        'packagePriceTitle',
        'price',
        'pricePer',
        'isPromo',
        'promoPrice',
        'priceDesc',
        'addBy',
        'editBy',
    ];

    public function packageTravel()
    {
        return $this->belongsTo(PackageTravel::class, 'travelpackageid', 'travelpackageid');
    }
}
