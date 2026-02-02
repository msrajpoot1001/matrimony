<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class ContentPagesContent extends Model
{
     protected $fillable=['type','heading','description'];
}
