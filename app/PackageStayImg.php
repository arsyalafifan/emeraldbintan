<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageStayImg extends Model
{
    protected $table = 'mt_stay_package_imgs';

    protected $primaryKey = 'staypackageimgid';

    protected $fillable = [
        'staypackageid',
        'imgUrl',
        'imgDesc',
        'addBy',
        'editBy',
    ];

    public function packageStay()
    {
        return $this->belongsTo(PackageStay::class, 'staypackageid', 'staypackageid');
    }
}
