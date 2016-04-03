<?php

namespace Quotinator\Http\Controllers\Api;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use McCool\LaravelAutoPresenter\Facades\AutoPresenter;

use Quotinator\Http\Requests;
use Quotinator\Http\Controllers\Controller;

class AbstractApiController extends Controller {
  /**
   * The HTTP response headers.
   *
   * @var array
   */
  protected $headers = [];

  /**
   * The HTTP response data.
   *
   * @var mixed
   */
  protected $data = null;

  /**
   * Optional response metadata.
   * @var mixed
   */
  protected $meta = null;

  /**
   * Optional response links.
   * @var mixed
   */
  protected $links = null;

  /**
   * The HTTP response status code.
   *
   * @var int
   */
  protected $statusCode = 200;

  /**
   * Set response data
   * @param mixed
   */
  protected function setData($data)
  {
    $this->data = $data;

    return $this;
  }

  /**
   * Set response metadata
   * @param Array $metadata [description]
   */
  protected function setMeta(Array $metadata)
  {
    $this->meta = $metadata;

    return $this;
  }

  /**
   * Set responses links
   * @param Array $linkdata
   */
  protected function setLinks(Array $linkdata)
  {
    $this->links = $linkdata;

    return $this;
  }

  /**
   * Creates response with pagination information
   * Follows guidelines set by http://jsonapi.org/format/#fetching-pagination
   * @param  Request   $request
   * @param  Paginator $paginator
   * @return \Illuminate\Http\Response
   */
  protected function paginator(Request $request, Paginator $paginator)
  {
    $meta = [
      'per-page' => $paginator->perPage(),
      'current-page' => $paginator->currentPage(),
      'last-page' => $paginator->lastPage(),
      'total' => $paginator->total(),
    ];

    $links = [
      'self' => $paginator->url($paginator->currentPage()),
      'first' => $paginator->url(1),
      'last' => $paginator->url($paginator->lastPage()),
      'prev' => $paginator->previousPageUrl(),
      'next' => $paginator->nextPageUrl(),
    ];

    $collection = $paginator->getCollection();

    return $this->setMeta($meta)->setLinks($links)->setData(AutoPresenter::decorate($collection))->respond();
  }

  protected function setStatusCode($statusCode)
  {
    $this->statusCode = $statusCode;

    return $this;
  }

  /**
   * Build the resource
   *
   * @return \Illuminate\Http\Response
   */
  protected function respond()
  {
    $response = [];

    if (!empty($this->meta))
    {
      $response['meta'] = $this->meta;
    }

    $response['data'] = $this->data;

    if (!empty($this->links))
    {
        $response['links'] = $this->links;
    }

    return Response::json($response, $this->statusCode, $this->headers);
  }
}
