<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table = 'store';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'app_id'
    ];
    public function apps() {
        return $this->belongsTo(App::class,'app_id');
    }
}
