<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeStatus extends BaseModel
{
    use HasFactory;
    protected $fillable = [];
    protected $table = 'employee_status';

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}
