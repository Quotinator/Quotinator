<?php

namespace Quotinator\Http\Controllers\Api;

use Illuminate\Http\Request;

use Quotinator\Quote;
use Quotinator\Http\Requests;

class QuoteController extends AbstractApiController
{
  /**
   * Get all Quotes
   * @return \Illuminate\Http\Response
   */
  public function getQuotes(Request $request)
  {
    $quotes = Quote::paginate(10);
    return $this->paginator($request, $quotes);
  }

  /**
   * Get a single Quote
   * @return \Illuminate\Http\Response
   */
  public function getQuote(Request $request, Quote $quote)
  {
    return $this->setData($quote)->respond();
  }

  /**
   * Create a new Quote
   * @return \Illuminate\Http\Response
   */
  public function postQuote(Request $request)
  {
    //TODO
  }

  /**
   * Update a single Quote
   * @param  Quote  $quote
   * @return \Illuminate\Http\Response
   */
  public function putQuote(Request $request, Quote $quote)
  {
    //TODO
  }
}
