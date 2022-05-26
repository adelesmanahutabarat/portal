<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parameter extends BaseModel
{
    use HasFactory;
    protected $fillable = [];
    protected $table = 'parameters';
}
