<?php

namespace TesBoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request)
    {

        $forbiden_hosts = array($this->getParameter('base_url'), "smtp", "www", "ftp");
        var_dump($forbiden_hosts);
        $host = $request->getHost();
        $base_host = ".".$this->getParameter('base_url');
        $user = str_replace($base_host,"",$host);

        if (in_array($user, $forbiden_hosts))
            echo "forbidden value ";
        else
            echo $user." bientôt";
        return $this->render('TesBoBundle:Default:index.html.twig');
    }
}
