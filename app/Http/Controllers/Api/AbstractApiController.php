<?php

namespace Quotinator\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
   * The HTTP response status code.
   *
   * @var int
   */
  protected $statusCode = 200;

  protected function setData($data)
  {
    $this->data = $data;

    return $this;
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

    $response['data'] = $this->data;

    return Response::json($response, $this->statusCode, $this->headers);
  }
}
