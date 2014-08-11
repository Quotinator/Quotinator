<?php
class RankTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ranks')->delete();

        $rank = new Rank;
        $rank->name = 'User';
        $rank->save();

        $rank = new Rank;
        $rank->name = 'Moderator';
        $rank->save();

        $rank = new Rank;
        $rank->name = 'Administrator';
        $rank->save();

        $user = User::where('username', '=', 'tjbenator')->first();
        $rank = Rank::where('name', '=', 'user')->first();
        $user->ranks()->attach($rank);
    }
}