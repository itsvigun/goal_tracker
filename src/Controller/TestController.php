<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class TestController
{
    /**
     * @Route("/first", name="first")
     */
    public function first()
    {
//        $em = $this->getDoctrine()->getManager();
//        $em->getConnection()->connect();
//        $connected = $em->getConnection()->isConnected();
        $a = 1;
        echo 1234;
        // ...
    }
}