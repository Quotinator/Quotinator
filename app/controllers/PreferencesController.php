<?php

class PreferencesController extends Controller
{
	public function getUser()
	{
		return View::make('preferences');
	}

	public function postUser()
	{
		$data = Input::all();

		$rules = array(
			'email' => 'email',
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
				if (strlen(Input::get('email')) > 0) 
				{
					$user->email = Input::get('email');
				}
				if (strlen(Input::get('newpassword')) > 0) 
				{
					$user->password = Hash::make(Input::get('newpassword'));
				}
				$user->save();
				return Redirect::to('/');	
			}
		} else {
			return Redirect::route('userpreferences')->withErrors(array('invalidpassword' => 'Invalid old password'));		
		}
		return Redirect::route('userpreferences')->withErrors($validator);	
	}
}