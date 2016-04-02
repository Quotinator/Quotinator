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
  public function getQuotes()
  {
    return $this->setData(Quote::all())->respond();
  }

  /**
   * Get a single Quote
   * @return \Illuminate\Http\Response
   */
  public function getQuote(Quote $quote)
  {
    return $this->setData($quote)->respond();
  }

  /**
   * Create a new Quote
   * @return \Illuminate\Http\Response
   */
  public function postQuote()
  {
    //TODO
  }

  /**
   * Update a single Quote
   * @param  Quote  $quote
   * @return \Illuminate\Http\Response
   */
  public function putQuote(Quote $quote)
  {
    //TODO
  }
}
