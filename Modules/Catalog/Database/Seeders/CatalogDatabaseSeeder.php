<?php

namespace Modules\Catalog\Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
class CatalogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
         // Create Permissions
         Permission::firstOrCreate(['name' => 'view_label']);
         \Artisan::call('auth:permission', [
            'name' => 'catalog_label',
        ]);
        Schema::enableForeignKeyConstraints();
        // $this->call("OthersTableSeeder");
    }
}
