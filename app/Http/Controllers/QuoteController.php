<?php

namespace Quotinator\Http\Controllers;

use Illuminate\Http\Request;

use Quotinator\Http\Requests;
use Quotinator\Http\Controllers\Controller;

use Quotinator\Quote;
use Quotinator\Http\Requests\StoreQuoteRequest;

class QuoteController extends Controller
{
  protected $Quote;

  const APPROVED = 1;
  const PENDING = 0;
  const DENIED = -1;

  public function __construct(Quote $Quote)
  {
    $this->Quote = $Quote;
    $this->middleware('auth', array('except' => ['index', 'show']));
  }

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    $title = 'Home';
    $quotes = $this->Quote->paginate(10);
    return view('home', compact('title', 'quotes'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function create()
  {
    $title = "Create";
    return view('editor', compact('title'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  Request  $request
  * @return Response
  */
  public function store(StoreQuoteRequest $request)
  {
    $status = self::PENDING;
    $title = $request->input('title');
    $quote = $request->input('quote');
    $new = \Auth::user()->quotes()->create(compact('title', 'quote', 'status'));
    $new->save();
    return redirect()->route('quote', $new->id);
  }

  /**
  * Display the specified resource.
  *
  * @param  Quote $quote
  * @return Response
  */
  public function show(Quote $quote)
  {
      $title = $quote->title;
      return view('quote', compact('title', 'quote'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  Quote $quote
  * @return Response
  */
  public function edit(Quote $quote)
  {
    $title = "Edit \"{$quote->title}\"";
    return view('editor', compact('title', 'quote'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  Request  $request
  * @param  Quote  $quote
  * @return Response
  */
  public function update(StoreQuoteRequest $request, Quote $quote)
  {
    $quote->title = $request->input('title');
    $quote->quote = $request->input('quote');
    $quote->save();
    return redirect()->route('quote', $quote->id);
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  Quote  $quote
  * @return Response
  */
  public function destroy(Quote $quote)
  {
    //
  }
}
