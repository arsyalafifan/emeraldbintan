<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageStayIncl extends Model
{
    protected $table = 'mt_stay_package_incls';

    protected $primaryKey = 'staypackageinclid';

    protected $fillable = [
        'staypackageid',
        'includeText',
        'addBy',
        'editBy',
    ];

    public function packageStay()
    {
        return $this->belongsTo(PackageStay::class, 'staypackageid', 'staypackageid');
    }
}
