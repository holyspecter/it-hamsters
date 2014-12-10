<?php

namespace ITHamsters\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class PublicController extends Controller
{
    /**
     * @Route("/", name="ith.homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('ITHamstersAppBundle:Public:index.html.twig', [
            'referral_url' => $this->get('hospect.referable_aware_router')->generate('ith.homepage'),
        ]);
    }
}
