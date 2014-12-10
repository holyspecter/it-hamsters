<?php

namespace Hospect\ReferralBundle\EventListener;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ReferralParameterListener
{
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request->query->has('ref')) {
            $response = new RedirectResponse($request->getBaseUrl());
            $response->headers->setCookie(new Cookie('hospect_ref', $request->query->get('ref')));

            $event->setResponse($response);
        }
    }
}
