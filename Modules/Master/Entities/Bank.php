<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'banks';

    public function bankaccount(){
        return $this->hasMany('Modules\Master\Entities\BankAccount');
    }
}
