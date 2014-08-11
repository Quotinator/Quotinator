<?php
class PermissionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();
        $nodes = array();
        $nodes[] = 'quote.submit';
        $nodes[] = 'quote.edit';
        $nodes[] = 'moderate.quote.approve';
        $nodes[] = 'moderate.quote.deny';
        $nodes[] = 'moderate.quote.delete';
        $nodes[] = 'administrate.site.settings';

        $rank = Rank::where('name', '=', 'administrator')->first();
        foreach ($nodes as $node) {
            $permission = new Permission;
            $permission->node = $node;
            $permission->save();
            $rank->permissions()->attach($permission);
        }
    }
}