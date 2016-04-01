<?php

namespace Quotinator\Http\Controllers\Api;

use Illuminate\Http\Request;

use Quotinator\Http\Requests;

class QuoteFavoriteController extends AbstractApiController
{
  /**
   * Get all Favorites for a Quote
   * @param  Quote  $quote
   * @return \Illuminate\Http\Response
   */
  public function getFavorites(Quote $quote)
  {
    //TODO
  }
}
