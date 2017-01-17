<?php

namespace TesBoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request)
    {

        $forbidden_hosts = array("smtp", "www", "ftp", "homepage");
        $host = $request->getHost();
        $base_host = ".".$this->getParameter('base_url');
        $user = str_replace($base_host,"",$host);

        if ($user == $this->getParameter('base_url'))
            $user = "homepage";
        elseif (in_array($user, $forbidden_hosts))
            $user = "forbidden";

        return $this->render('TesBoBundle:Default:index.html.twig', array('user' => $user));
    }
}
