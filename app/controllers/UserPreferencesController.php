<?php

class UserPreferencesController extends Controller
{
	public function getMain()
	{
		return View::make('user.preferences.main');
	}

	public function getEditAccount()
	{
		return View::make('user.preferences.account');
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
			return Redirect::route('user.preferences.account')->withErrors(array('invalidpassword' => 'Invalid old password'));		
		}
		return Redirect::route('user.preferences.account')->withErrors($validator);
	}

	public function getEditProfile()
	{
		return View::make('user.preferences.profile');
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
				return Redirect::route('user.preferences');	
			}
		}
		return Redirect::route('user.preferences.profile')->withErrors($validator);
	}
}