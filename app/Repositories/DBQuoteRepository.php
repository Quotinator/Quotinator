<?php namespace Quotinator\Repositories;

use Quotinator\Quote;
use Quotinator\Repositories\QuoteRepositoryInterface;

class DBQuoteRepository implements QuoteRepositoryInterface {
  protected $Quote;

  public function __construct(Quote $Quote)
  {
    $this->Quote = $Quote;
  }

  public function getPaginated(array $params)
  {
      switch ($params['sortBy']) {
        case "top":
          return $this->Quote->orderBy('confidence', 'desc')->paginate(10);
          break;

        case "random":
          //Limit as we can't retain the random
          return $this->Quote->orderByRaw('RAND()')->limit(10)->paginate(10);
          break;

        default:
          return $this->Quote->orderBy('id', 'desc')->paginate(50);
      }
  }
}
