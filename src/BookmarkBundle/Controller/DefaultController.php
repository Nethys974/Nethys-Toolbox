<?php

namespace BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BookmarkBundle:Default:index.html.twig');
    }
}
