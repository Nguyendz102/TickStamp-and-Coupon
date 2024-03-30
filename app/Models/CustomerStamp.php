<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerStamp extends Model
{
    use HasFactory;
    protected $table = 'customer_stamp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'app_id',
        'customer_id',
        'count_stamp',
    ];
    public function stamp_customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
