<?php

namespace Quotinator\Http\Controllers;

use Illuminate\Http\Request;

use Quotinator\User;
use Quotinator\Quote;
use Quotinator\Http\Requests;
use Quotinator\Http\Controllers\Controller;
use Quotinator\Repositories\QuoteRepositoryInterface;

class ProfileController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth', array('except' => ['getFavorites', 'show']));
  }

  public function getFavorites(User $user, Request $request)
  {

  }

  public function getIndex(User $user, Request $request)
  {
    $direction = $request->get('direction', 'Desc');
    $title = "{$user->username}'s Quotes";
    $quotes = $user->quotes()->paginate(10);
    return view('home', compact('title', 'quotes'));
  }

  public function getQuotes(User $user)
  {
    //
  }
}
