<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageStamp extends Model
{
    use HasFactory;
    protected $table = 'image_stamp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'after_image',
        'before_image',
        'post_stamp',
        'stamp_id'
    ];

}
