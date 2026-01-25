<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageStayPrice extends Model
{
    protected $table = 'mt_stay_package_prices';

    protected $primaryKey = 'staypackagepriceid';

    protected $fillable = [
        'staypackageid',
        'stayPriceTitle',
        'price',
        'pricePer',
        'isPromo',
        'promoPrice',
        'priceDesc',
        'addBy',
        'editBy',
    ];

    public function packageStay()
    {
        return $this->belongsTo(PackageStay::class, 'staypackageid', 'staypackageid');
    }
}
