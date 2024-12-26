<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    
    protected $fillable = ['image_description', 'upload_path'];
    protected $guarded = ['id'];

}
