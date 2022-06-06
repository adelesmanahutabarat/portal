<?php

namespace Modules\Payroll\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayrollDetail extends Model
{
    use HasFactory;
    protected $fillable = ['date_period','branch_id','user_id','amount'];
    protected $table = 'payroll_details';
}