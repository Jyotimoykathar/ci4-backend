<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Get allowed origin from .env or use wildcard for development
    $allowedOrigin = env('app.corsAllowedOrigins', 'http://localhost:5173');

    // Handle preflight (OPTIONS) requests
    if ($request->getMethod(true) === 'OPTIONS') {
      $response = service('response');
      $response->setHeader('Access-Control-Allow-Origin', 'http://localhost:5173');
      $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
      $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
      $response->setHeader('Access-Control-Allow-Credentials', 'true');
      $response->setHeader('Access-Control-Max-Age', '3600');
      $response->setStatusCode(200);
      $response->setBody('');
      return $response; // Return the response instead of exit
    }

    return $request;
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    $allowedOrigin = env('app.corsAllowedOrigins', 'http://localhost:5173');

    // Apply CORS headers to all responses
    $response->setHeader('Access-Control-Allow-Origin', 'http://localhost:5173');
    $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
    $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    $response->setHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
  }
}
