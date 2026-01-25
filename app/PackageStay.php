<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageStay extends Model
{
    protected $table = 'mt_stay_package';

    protected $primaryKey = 'staypackageid';

    protected $fillable = [
        'slug',
        'stayTitle',
        'stayDesc',
        'isRibbon',
        'ribbonText',
        'addBy',
        'editBy',
    ];

    public function prices()
    {
        return $this->hasMany(PackageStayPrice::class, 'staypackageid', 'staypackageid');
    }
    public function includes()
    {
        return $this->hasMany(PackageStayIncl::class, 'staypackageid', 'staypackageid');
    }
    public function images()
    {
        return $this->hasMany(PackageStayImg::class, 'staypackageid', 'staypackageid');
    }
}
