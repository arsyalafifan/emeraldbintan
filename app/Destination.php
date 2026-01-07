<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use SoftDeletes;

    protected $table = 'mt_destination';

    protected $primaryKey = 'destinationid';

    protected $fillable = [
        'destinationName',
        'destinationDesc',
        'destinationUrl',
        'addBy',
        'editBy',
    ];

    public function packageTravelDestinations()
    {
        return $this->hasMany(
            PackageTravelDest::class,
            'destinationid',
            'destinationid'
        );
    }
}
