<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container as Application;
use App\Modules\DataModel\Models\Account;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('Account')->truncate();

        factory(Account::class,'administrator', 20)->create();
        factory(Account::class,'editor', 20)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Model::reguard();
    }
}
