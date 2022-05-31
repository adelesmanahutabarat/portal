<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'employee_status';

}
