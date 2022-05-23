<?php

namespace Modules\Catalog\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Modules\Catalog\Entities\Presenters\CatalogPresenter;
class Catalog extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    use CatalogPresenter;
    protected $table = 'catalogs';
    protected $primaryKey = 'id'; // or null
    // public $incrementing = false;
    // protected $keyType = 'string';
    // protected static $logName = 'posts';
    // protected static $logOnlyDirty = true;
    // protected static $logAttributes = ['name', 'intro', 'content', 'type', 'category_id', 'category_name', 'is_featured', 'meta_title', 'meta_keywords', 'meta_description', 'published_at', 'moderated_at', 'moderated_by', 'status', 'created_by_alias'];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->cid = IdGenerator::generate(['table' => 'catalogs','field'=>'cid', 'length' => 7, 'prefix' =>'PR']);
        });
    }
    public function files(){
		return $this->hasMany('Modules\Catalog\Entities\CatalogFiles');
	}
    protected static function newFactory()
    {
        return \Modules\Catalog\Database\factories\CatalogFactory::new();
    }
}
