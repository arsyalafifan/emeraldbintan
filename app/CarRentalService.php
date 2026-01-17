<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarRentalService extends Model
{
    use SoftDeletes;

    protected $table = 'mt_car_rental_services';
    protected $primaryKey = 'carrentalserviceid';
    protected $fillable = [
        'type',
        'pricehalfday',
        'pricefullday',
        'pricewholeday',
        'priceadditional',
        'includes',
        'addBy',
        'editBy'
    ];
    public function images()
    {
        return $this->hasMany(CarRentalServiceImg::class, 'carrentalserviceid', 'carrentalserviceid');
    }
}
