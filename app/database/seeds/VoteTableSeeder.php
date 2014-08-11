<?php
class VoteTableSeeder extends Seeder {

    public function run()
    {
        DB::table('votes')->delete();

        $vote = new Vote;
        $vote->vote = 1;

        $quote = Quote::where('title', '=', 'Test Quote')->first();
        $user = User::where('username', '=', 'tjbenator')->first();
        $vote->user()->associate($user);
        $vote->quote()->associate($quote);
        
		$vote->save();

    }
}