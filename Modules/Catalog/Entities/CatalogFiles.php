<?php

namespace Modules\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatalogFiles extends Model
{
    use HasFactory;
    protected $table = 'catalog_files';
    function catalog(){
		return $this->belongsTo('Modules\Catalog\Entities\Catalog','catalog_id','id');
	}
    protected static function newFactory()
    {
        return \Modules\Catalog\Database\factories\CatalogFilesFactory::new();
    }
}
