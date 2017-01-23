<?php

namespace TesBoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function getGaleries($name)
    {
        $gallery = $this->getDoctrine()
            ->getRepository('TesBoBundle:Galleries')
            ->findByName($name);
        return $gallery;
    }

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

        $gallery = self::getGaleries($user);
        if ($gallery)
            return $this->render('TesBoBundle:Default:gallery.html.twig', array('user' => $user, "gallery" => $gallery));
        else
            return $this->render('TesBoBundle:Default:index.html.twig', array('user' => $user, "gallery" => $gallery));
    }
}
