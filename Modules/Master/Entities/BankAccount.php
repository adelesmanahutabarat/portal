<?php

namespace Modules\Master\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends Model
{
    use HasFactory;
    protected $table = 'bank_accounts';

    protected $fillable = [
		'account_number',
		'name_on_account',
		'user_id', 
    'bank_id',
    'created_by',
    'created_by_name'
	];

  function bank(){
		return $this->belongsTo('Modules\Master\Entities\Bank','bank_id','id');
	}
  function user(){
    return $this->belongsTo('App\Models\User','user_id','id');
  }
}