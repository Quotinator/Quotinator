<?php
class PermissionTableSeeder extends Seeder {

    public function run()
    {
        $roles = [
            ['name' => 'Administrator', 'weight' => 3],
            ['name' => 'Moderator', 'weight' => 2],
            ['name' => 'User', 'weight' => 1],
        ];
        $permissions = [
            ['weight' =>  '1', 'node' => 'quote.editor',      'description' => 'The ability to use the editor'],
            ['weight' =>  '1', 'node' => 'quote.edit',        'description' => 'The ability to edit an existing quote'],
            ['weight' =>  '2', 'node' => 'quote.edit.others', 'description' => 'The ability to edit an existing quote that isn\'t yours'],
            ['weight' =>  '1', 'node' => 'quote.new',         'description' => 'The ability to create a new quote'],
            ['weight' =>  '2', 'node' => 'quote.approve',     'description' => 'The ability to approve a quote'],
            ['weight' =>  '2', 'node' => 'quote.deny',        'description' => 'The ability to deny a quote'],
            ['weight' =>  '1', 'node' => 'quote.upvote',      'description' => 'The ability to upvote a quote'],
            ['weight' =>  '1', 'node' => 'quote.downvote',    'description' => 'The ability to downvote a quote'],
            ['weight' =>  '1', 'node' => 'quote.favorite',    'description' => 'The ability to create favorites'],
            ['weight' =>  '1', 'node' => 'user.preferences',  'description' => 'The ability to access user preferences'],
            ['weight' =>  '3', 'node' => 'site.preferences',  'description' => 'The ability to access site preferences'],
        ];

        foreach ($permissions as $permission)
        {
            $perm = Permission::firstOrNew(['node' => $permission['node']]);
            $perm->description = $permission['description'];
            $perm->save();
        }

        foreach ($roles as $r)
        {
            $this->command->info('Adding permissions to ' . $r['name']);
            $role = Role::where('name', $r['name'])->first();
            foreach ($permissions as $p)
            {
                if ($p['weight'] <= $r['weight'])
                {
                    $this->command->info('Giving ' . $r['name'] .' the '. $p['node'] . ' node');
                    $permission = Permission::where('node', $p['node'])->first();
                    if (!$role->permissions->contains($permission->id))
                    {
                        $role->permissions()->attach($permission);
                    }
                }
            }
        }

    }
}