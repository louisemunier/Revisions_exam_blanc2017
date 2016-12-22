<?php

namespace ExamBlancBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ExamBlanc/default/index.html.twig');
    }

    public function algoAction()
    {
        return $this->render('ExamBlancBundle:Algorithmique:index.html.twig');
    }

    public function sf2Action()
    {
        return $this->render('@ExamBlanc/SF2/index.html.twig');
    }
}
