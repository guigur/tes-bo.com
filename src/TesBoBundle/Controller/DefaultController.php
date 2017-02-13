<?php

namespace TesBoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

    public function addMediaTypeAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $media = new mediaTypes();
        $form = $this->createFormBuilder($media)
            ->add('type', TextType::class)
            ->add('code', TextType::class)
            ->add('family', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'add mediatype'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();
        }

        return $this->render('TesBoBundle:Default:addMedias.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function addMediaAction(Request $request)
    {
        // create a task and give it some dummy data for this example


        $mediaType = $this->getDoctrine()
            ->getRepository('TesBoBundle:MediaTypes')
            ->findOneByType("png");

        $gallerie = $this->getDoctrine()
            ->getRepository('TesBoBundle:Galleries')
            ->findOneByName("test");

        $user = $this->getDoctrine()
            ->getRepository('TesBoBundle:users')
            ->findOneByPseudo("admin");

        $media = new medias();
        $form = $this->createFormBuilder($media)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('media', FileType::class)
            ->add('save', SubmitType::class, array('label' => 'add media'))
            ->getForm();

        $media->setMediaType($mediaType);
        $media->setDatetimePosted(new \DateTime());
        $media->setIsVisible(1);
        $media->setGallerie($gallerie);
        $media->setUser($user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();
        }

        return $this->render('TesBoBundle:Default:addMedias.html.twig', array(
            'form' => $form->createView(),
        ));
    }
/*
    public function addMediaAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $media = new Medias();
        $media->setTitle('Write a blog post');

        //$media->setDescription("desc test");
        $media->setMediaType(1);
        $media->setDatetimePosted(new \DateTime());
        $media->setIsVisible(1);
        $media->setGallerie(1);
        $media->setUser(1);

        $form = $this->createFormBuilder($media)
            ->add('title', TextType::class)
            ->add('description', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'add media'))
            ->getForm();

        return $this->render('TesBoBundle:Default:addMedias.html.twig', array(
            'form' => $form->createView(),
        ));
    }*/


    public function addMediaRequestAction(Request $request)
    {
        $media = new Medias();

        $form = $this->createFormBuilder($media)
            ->add('title', TextType::class)
            ->add('description', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'add media'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media = $form->getData();
            return $this->redirectToRoute('task_success');
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


}
