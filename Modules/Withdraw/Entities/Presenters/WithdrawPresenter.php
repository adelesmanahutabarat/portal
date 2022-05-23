<?php

namespace Modules\Withdraw\Entities\Presenters;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait WithdrawPresenter
{
    public function getPublishedAtFormattedAttribute()
    {
        $diff = Carbon::now()->diffInHours($this->published_at);

        if ($diff < 24) {
            return $this->published_at->diffForHumans();
        } else {
            return $this->published_at->isoFormat('llll');
        }
    }

    public function getPublishedAtFormattedBengaliAttribute()
    {
        $diff = Carbon::now()->diffInHours($this->published_at);

        if ($diff < 24) {
            return $this->published_at->diffForHumans();
        } else {
            $date_string = $this->published_at->isoFormat('llll');
        }

        $return_string = en2bnDate($date_string);

        return $return_string;
    }

    public function getStatusFormattedAttribute()
    {
        switch ($this->status) {
            case '0':
                return '<span class="badge badge-warning">Pending</span>';
                break;

            case '1':
                return '<span class="badge badge-success">Diterima</span>';
                break;

            case '2':
                return '<span class="badge badge-info">Draft</span>';
                break;

            default:
                return '<span class="badge badge-primary">Status:'.$this->status.'</span>';
                break;
        }
    }
}
