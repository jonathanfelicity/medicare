<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = "product";
    protected $primarykey = "id";
    protected $fillable = ["name","description","nafdacno","price","quantity"];
}
