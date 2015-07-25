<?php

namespace Quotinator\Http\Controllers;

use Illuminate\Http\Request;

use Quotinator\Http\Requests;
use Quotinator\Http\Controllers\Controller;

use Quotinator\Quote;
use Quotinator\Http\Requests\StoreQuoteRequest;
use Quotinator\Repositories\QuoteRepositoryInterface;
use Quotinator\Repositories\Exceptions\QuoteNotFoundException;

class QuoteController extends Controller
{
  protected $QuoteRepository;
  public function __construct(QuoteRepositoryInterface $QuoteRepository)
  {
    $this->QuoteRepository = $QuoteRepository;
    $this->middleware('auth', array('except' => ['index', 'show']));
  }

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index(Request $request)
  {
    $sortBy = $request->get('sortBy', 'Home');
    $direction = $request->get('direction', 'Asc');
    $title = $sortBy;
    $quotes = $this->QuoteRepository->getPaginated(compact('sortBy', 'direction'));
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
      $quote = $this->QuoteRepository->create($request);
      return redirect()->route('quote', $quote->id);
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
    $this->QuoteRepository->update($quote, $request);
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
