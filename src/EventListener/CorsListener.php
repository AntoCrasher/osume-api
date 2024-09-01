<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;

class CorsListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        // Set the CORS headers for all requests
        $response = $event->getResponse() ?: new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // Handle preflight request
        if ($request->getMethod() === 'OPTIONS') {
            $event->setResponse($response);
            return;
        }
    }
}