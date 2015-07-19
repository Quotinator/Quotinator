<?php namespace Quotinator\Repositories;


interface QuoteRepositoryInterface {
  public function getPaginated(array $params);
}
