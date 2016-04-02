<?php
namespace Quotinator\Presenters;

use Quotinator\Quote;
use McCool\LaravelAutoPresenter\BasePresenter;

class QuotePresenter extends BasePresenter
{
    public function __construct(Quote $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function created_about()
    {
        return $this->wrappedObject->created_at->diffForHumans();
    }
}
