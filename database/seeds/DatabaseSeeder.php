<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        factory('Quotinator\User', 3)
                   ->create()
                   ->each(function($u) {
                      for ($i=0; $i < 10; $i++) {
                         $u->quotes()->save(factory('Quotinator\Quote')->make());
                      }
                    });


        Model::reguard();
    }
}
