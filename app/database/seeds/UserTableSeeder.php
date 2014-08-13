<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        //User::create(array('email' => 'foo@bar.com'));
        $user = new User;
        $user->username = 'tjbenator';
        $user->email = 'tjbenator@gmail.com';
        $user->password = Hash::make('Test');
        $user->about = 'tjbenator enjoys tummy slides and long walks in the snow.';
        $user->save();        
    }
}