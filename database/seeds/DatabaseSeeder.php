<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

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
                   ->each(function ($u) {
                      for ($i = 0; $i < 10; $i++) {
                          $u->quotes()->save(factory('Quotinator\Quote')->make());
                      }
                    });

        Model::reguard();
    }
}
