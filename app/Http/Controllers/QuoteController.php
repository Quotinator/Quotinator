<?php

namespace Quotinator\Http\Controllers;

use Illuminate\Http\Request;

use Quotinator\Http\Requests;
use Quotinator\Http\Controllers\Controller;

use Quotinator\Repositories\QuoteRepositoryInterface;
use Quotinator\Repositories\Exceptions\QuoteNotFoundException;

class QuoteController extends Controller
{
  protected $QuoteRepository;
  public function __construct(QuoteRepositoryInterface $QuoteRepository)
  {
    $this->QuoteRepository = $QuoteRepository;
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
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show($quote)
  {
      $title = $quote->title;
      return view('quote', compact('title', 'quote'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function edit($quote)
  {
    $title = "Edit \"{$quote->title}\"";
    return view('editor', compact('title', 'quote'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  Request  $request
  * @param  int  $id
  * @return Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function destroy($id)
  {
    //
  }
}
