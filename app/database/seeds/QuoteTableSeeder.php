<?php
class QuoteTableSeeder extends Seeder {

    public function run()
    {
        DB::table('quotes')->delete();

        $quote = new Quote;
        $quote->title = 'Test Quote';
        $quote->quote = 'This is a quote';
        $quote->status = 0;
        $quote->confidence = 0;

        $user = User::where('username', '=', 'tjbenator')->first();
		$user->quotes()->save($quote);

		$quote = new Quote;
        $quote->title = 'Test Quote #2';
        $quote->quote = 'This is a another quote';
        $quote->status = 0;
        $quote->confidence = 0;
        
        $user = User::where('username', '=', 'tjbenator')->first();
		$user->quotes()->save($quote);

    }
}