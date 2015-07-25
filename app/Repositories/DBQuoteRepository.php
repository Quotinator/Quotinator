<?php namespace Quotinator\Repositories;

use Quotinator\Quote;
use Quotinator\Http\Requests\Request;
use Quotinator\Repositories\QuoteRepositoryInterface;
use Quotinator\Repositories\Exceptions\QuoteNotFoundException;

class DBQuoteRepository implements QuoteRepositoryInterface {
  protected $Quote;

  const APPROVED = 1;
  const PENDING = 0;
  const DENIED = -1;

  public function __construct(Quote $Quote)
  {
    $this->Quote = $Quote;
  }

  public function create(Request $request)
  {
    $status = DBQuoteRepository::PENDING;
    $title = $request->input('title');
    $quote = $request->input('quote');
    $new = \Auth::user()->quotes()->create(compact('title', 'quote', 'status'));
    $new->save();
    return $new;
  }

  public function update(Quote $quote, Request $request)
  {
    $quote->title = $request->input('title');
    $quote->quote = $request->input('quote');
    $quote->save();
    return $quote;
  }

  public function getSingle($id)
  {
    $quote = $this->Quote->whereId($id)->first();
    if ($quote instanceof \Quotinator\Quote)
    {
      return $quote;
    }
    else
    {
      throw new QuoteNotFoundException($id);
    }
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
