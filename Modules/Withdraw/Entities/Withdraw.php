<?php

namespace Modules\Withdraw\Entities;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Withdraw\Entities\Presenters\WithdrawPresenter;
class Withdraw extends BaseModel
{
    use HasFactory;
    use WithdrawPresenter;
    use SoftDeletes;
    protected $table = 'withdraws';
    protected $fillable = [
        'amount','description','approved_at','approved_description','proof_of_payment','status','created_by_name'
    ];
    protected static function newFactory()
    {
        return \Modules\Withdraw\Database\factories\WithdrawFactory::new();
    }
}
