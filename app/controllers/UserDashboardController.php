<?php

class UserDashboardController extends PageController
{
	public function getMain()
	{
		$moderatequotes = Quote::orderBy('id', 'desc')->whereStatus(0);
		$quotes = Auth::user()->quotes()->orderBy('id', 'desc')->paginate(Config::get('settings.per_page'));

		$this->layout->title = 'Dashboard';
		$this->layout->nest('content', 'user.dashboard.main', ['quotes' => $quotes, 'moderatequotes' => $moderatequotes]);
	}

	public function getEditAccount()
	{
		$this->layout->title = 'Dashboard - Account';
		$this->layout->content = View::make('user.dashboard.account');
	}

	public function postEditAccount()
	{
		$data = Input::all();

		$rules = array(
			'email' => 'email',
			'about' => 'max:1024',
			'newpassword' => 'confirmed|min:8',
			'password' => 'required'
			);
		if ( Auth::validate(array('username' => Auth::User()->username, 'password' => Input::get('password'))) )
		{
			$messages = array(
				'newpassword.min' => 'Your new password must be at least :min characters',
				'newpassword.confirmed' => 'Your new passwords do not match'
				);
			$validator = Validator::make($data, $rules, $messages);

			if ($validator->passes()) 
			{
				$user = Auth::User();				
				if (Input::has('email')) 
				{
					$user->email = Input::get('email');
				}
				if (Input::has('newpassword'))
				{
					$user->password = Hash::make(Input::get('newpassword'));
				}

				$user->save();
				return Redirect::to('/');	
			}
		} else {
			return Redirect::route('user.dashboard.account')->withErrors(array('invalidpassword' => 'Invalid old password'));		
		}
		return Redirect::route('user.dashboard.account')->withErrors($validator);
	}

	public function getEditProfile()
	{
		$this->layout->title = 'Dashboard - Profile';
		$this->layout->content = View::make('user.dashboard.profile');
	}

	public function postEditProfile()
	{
		$data = Input::all();

		$rules = array(
			'about' => 'max:1024',
			);
		if ( Auth::check() )
		{
			$messages = array(
				);
			$validator = Validator::make($data, $rules, $messages);

			if ($validator->passes()) 
			{
				$user = Auth::User();				

				$user->about = Input::get('about');

				$user->save();
				return Redirect::route('user.dashboard');	
			}
		}
		return Redirect::route('user.dashboard.profile')->withErrors($validator);
	}
}