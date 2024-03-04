<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;
    protected $table = 'stamp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'maxstamp',
        'app_id',
        'one_stamp_per_day',
    ];
    public function apps() {
        return $this->belongsTo(App::class,'app_id');
    }
}
