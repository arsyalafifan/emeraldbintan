<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRentalServiceImg extends Model
{
    use SoftDeletes;

    protected $table = 'mt_car_rental_service_imgs';
    protected $primaryKey = 'carrentalserviceimgid';
    protected $fillable = [
        'carrentalserviceid',
        'imgUrl',
        'imgDesc',
        'addBy',
        'editBy'
    ];

    public function carRentalService()
    {
        return $this->belongsTo(CarRentalService::class, 'carrentalserviceid', 'carrentalserviceid');
    }
}
