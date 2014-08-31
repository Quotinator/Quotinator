<?php
class PermissionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        $permissions[]['node'] = 'quote.edit';
        $permissions[]['node'] = 'quote.submit';
        $permissions[]['node'] = 'quote.approve';
        $permissions[]['node'] = 'quote.deny';
        $permissions[]['node'] = 'quote.favorite';
        $permissions[]['node'] = 'user.preferences';
        $permissions[]['node'] = 'site.preferences';
        $role = Role::where('name', '=', 'Administrator')->first();
        foreach ($permissions as $permission) {
            $perm = new Permission;
            $perm->node = $permission['node'];
            $perm->description = ucfirst(str_replace('.', ' ', $permission['node']));
            $perm->save();
            $role->permissions()->attach($perm);
        }

    }
}