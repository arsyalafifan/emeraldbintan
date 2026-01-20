<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxiService extends Model
{
    use SoftDeletes;

    protected $table = 'mt_taxi_services';
    protected $primaryKey = 'taxiserviceid';

    protected $fillable = [
        'destinationid',
        'destinationid_from',
        'price7seatoneway',
        'price7seattwoway',
        'price14seatoneway',
        'price14seattwoway',
        'addBy',
        'editBy'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destinationid', 'destinationid');
    }
    public function destinationFrom()
    {
        return $this->belongsTo(Destination::class, 'destinationid_from', 'destinationid');
    }
}
