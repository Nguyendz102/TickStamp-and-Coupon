<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class App extends Model
{
    use HasFactory;
    protected $table = 'app';
    protected $primaryKey = 'id';
    protected $fillable = [
        'app_name',
        'stamp_images',
        'status',
        'id_users',
    ];

    public function user() {
        return $this->belongsTo(User::class,'id_users');
    }
    public function stamp() {
        return $this->hasMany(Stamp::class);
    }
    public function stores() {
        return $this->hasMany(Store::class);
    }
 
}
