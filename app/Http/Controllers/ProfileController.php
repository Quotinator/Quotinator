<?php

namespace Quotinator\Http\Controllers;

use Illuminate\Http\Request;

use Log;
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

  public function getFavorites(Request $request, User $user)
  {
    $title = "{$user->username}'s Favorites";
    $quotes = $user->favorites()->sortable(['id' => 'desc'])->paginate(10);
    return view('profile.favorites', compact('title', 'user', 'quotes'));
  }

  public function getIndex(Request $request, User $user)
  {
    $title = "{$user->username}'s Profile";
    if ($request->user()->username === $user->username)
    {
      $quotes = $user->quotes()->take(5)->get();
    } else {
      $quotes = $user->quotes()->status('Approved')->take(5)->get();
    }
    return view('profile.user', compact('title', 'user', 'quotes'));
  }

  public function getQuotes(Request $request, User $user)
  {
    $title = "{$user->username}'s Quotes";
    if ($request->user()->username === $user->username)
    {
      $quotes = $user->quotes()->sortable(['id' => 'desc'])->paginate(10);
    }
    else
    {
      $quotes = $user->quotes()->status('Approved')->sortable(['id' => 'desc'])->paginate(10);
    }
    return view('profile.quotes', compact('title', 'user', 'quotes'));
  }
}
