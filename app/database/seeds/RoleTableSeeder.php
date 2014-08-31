<?php
class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $user_role = new Role;
        $user_role->name = 'User';
        $user_role->save();

        $mod_role = new Role;
        $mod_role->name = 'Moderator';
        $mod_role->save();

        $admin_role = new Role;
        $admin_role->name = 'Administrator';
        $admin_role->save();

        $user = User::where('username', '=', 'tjbenator')->first();
        $role = Role::where('name', '=', 'Administrator')->first();
        $user->roles()->attach($role);
    }
}