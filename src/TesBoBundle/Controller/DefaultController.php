<?php

namespace TesBoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
<<<<<<< HEAD
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\DateTime;
use TesBoBundle\Entity\Medias;
use TesBoBundle\Entity\MediaTypes;


//use AppBundle\Entity\Task;
=======
require_once __DIR__ . "vendor/autoload.php";
use duncan3dc\Speaker\TextToSpeech;
use duncan3dc\Speaker\Providers\GoogleProvider;
>>>>>>> c2ccd2d5aca7cb553776f323d1aa8ffae0219ff7
=======
>>>>>>> parent of a6cadbf... added form test add media not working

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
            $entity->setMediaPath(base64_encode(stream_get_contents($entity->getMedia())));
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
        else {



            $provider = new GoogleProvider;

            $tts = new TextToSpeech("Hello World", $provider);
            $tts->save("/tmp/hello.mp3");

            return $this->render('TesBoBundle:Default:index.html.twig', array('user' => $user, "gallery" => $gallery));
        }
    }
}
