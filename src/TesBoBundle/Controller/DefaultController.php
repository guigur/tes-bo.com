<?php

namespace TesBoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function getGallerie($name)
    {
        $gallery = $this->getDoctrine()
            ->getRepository('TesBoBundle:Galleries')
            ->findOneByName($name);
        return $gallery;
    }

    public function getMedias($galleryID)
    {
        $medias = $this->getDoctrine()
            ->getRepository('TesBoBundle:Medias')
            ->findByGallerie($galleryID);

        foreach ($medias as $key => $entity)
        {
            //echo $entity->getMediaType()->getFamily();
            $entity->setMediaPath(base64_encode(stream_get_contents($entity->getMedia())));
        }
            return $medias;
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

        if ($gallery = self::getGallerie($user))
        {
            $medias = self::getMedias($gallery->getId());
            return $this->render('TesBoBundle:Default:gallery.html.twig', array('user' => $user, "gallery" => $gallery, "medias" => $medias));
        }
        else
            return $this->render('TesBoBundle:Default:index.html.twig', array('user' => $user, "gallery" => $gallery));
    }
}
