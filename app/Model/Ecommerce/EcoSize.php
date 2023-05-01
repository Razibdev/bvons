<?php

namespace App\Model\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class EcoSize extends Model
{
     protected $fillable = array('id', 'all_size','subcategories_id');
}
