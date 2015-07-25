<?php namespace Quotinator\Repositories;


interface QuoteRepositoryInterface {
  public function getSingle($id);
  public function getPaginated(array $params);
}
