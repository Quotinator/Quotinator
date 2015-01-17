<?php

class InstallSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('QuoteTableSeeder');
		$this->call('VoteTableSeeder');
		$this->call('RoleTableSeeder');
		$this->call('PermissionTableSeeder');
	}

}
