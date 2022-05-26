<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends BaseModel
{
    use HasFactory;
    protected $fillable = [];
    protected $table = 'branches';
}
