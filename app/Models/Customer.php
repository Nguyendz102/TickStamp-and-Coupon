<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'sdt',
        'coupon_id',
    ];
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'app_id');
    }
}
