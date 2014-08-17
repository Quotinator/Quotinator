<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class QuotinatorMigrateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'quotinator:migrate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Migrate a legacy Quotinator database to new Laravel Database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->line('Lets start our migration.');

		//Migrate Groups to Roles
		$groups = DB::connection('oldmysql')->table('groups');
		$this->line($groups->count() . ' groups[\'s] were found in the legacy database');

		foreach($groups->get() as $group) {
			$role = new Role;
			$role->name = $group->group;
			$role->save();
		}

		//Migrate Users
		$users = DB::connection('oldmysql')->table('users');
		$this->line($users->count() . ' user[\'s] were found in the legacy database');

		foreach ($users->get() as $user) {
			$this->line('Migrating user: ' . $user->username);
			$newuser = new User();
			$newuser->id = $user->id;
			$newuser->username = $user->username;
			$newuser->email = $user->email;
			$newuser->save();
			//Migrate there group to a role
			$group = DB::connection('oldmysql')->table('groups')->where('id', $user->group)->first();
			$myrole = Role::where('name', $group->group)->first();
			$newuser->roles()->attach($myrole);
			$this->line('Adding user to role: ' . $group->group);
		}

		//Migrate Users
		$quotes = DB::connection('oldmysql')->table('quotes');
		$this->line($quotes->count() . ' quote[\'s] were found in the legacy database');

		foreach ($quotes->get() as $quote) {
			$this->line('Migrating quote: #' . $quote->id);
			$newquote = new Quote();
			$newquote->timestamps = false;
			$newquote->id = $quote->id;
			$newquote->title = $quote->title;
			$newquote->quote = $quote->quote;
			$user = User::find($quote->userid);
			$newquote->user()->associate($user);
			$newquote->status = $quote->approved;

			$newquote->created_at = date('Y-m-d H:i:s', $quote->timestamp);
			$newquote->updated_at = date('Y-m-d H:i:s', $quote->timestamp);
			$newquote->save();
		}

		$votes = DB::connection('oldmysql')->table('votes');
		$this->line($votes->count() . ' vote[\'s] were found in the legacy database');
		foreach ($votes->get() as $vote) {
			$user = User::find($vote->userid);
			$quote = Quote::find($vote->quoteid);
			if ($user && $quote) {
				if ($vote->vote == 1) {
					$this->line($user->username . ' voted up #' . $quote->id);
				} else {
					$this->line($user->username . ' voted down #' . $quote->id);
				}
				if ($quote) {
					$vuser = $quote->voted()->whereUserId($vote->userid)->first();
					if (!$vuser) {
						$quote->voted()->attach($user, array('vote' => $vote->vote));
					} else {
						$vuser->pivot->vote = $vote->vote;
						$vuser->pivot->save();
					}
				}
				//Our confidence has changed in this quote.
				$quote->updateVoteConfidence();
			} else {
				if (!$quote) {
					$this->line('Vote #' . $vote->id . ' could not be imported because the quote doesn\'t exist');
				}
				if (!$user) {
					$this->line('Vote #' . $vote->id . ' could not be imported because the user doesn\'t exist');
				}
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
	// 	);
	// }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	// protected function getOptions()
	// {
	// 	return array(
	// 		array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
	// 	);
	// }

}
