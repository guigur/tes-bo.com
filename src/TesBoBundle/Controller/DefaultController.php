<?php

namespace TesBoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\DateTime;
use TesBoBundle\Entity\Medias;
use TesBoBundle\Entity\MediaTypes;
use TesBoBundle\Entity\Users;


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

    public function registerAction(Request $request)
    {




        $em = $this->getDoctrine()->getManager();
        // just setup a fresh $task object (remove the dummy data)
        $user = new Users();

        $form = $this->createFormBuilder($user)
            ->add('pseudo', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password')))
            ->add('email', RepeatedType::class, array(
                'type' => EmailType::class,
                'invalid_message' => 'The emails fields must match.',
                'required' => true,
                'first_options'  => array('label' => 'email'),
                'second_options' => array('label' => 'Repeat email')))
            ->add('save', SubmitType::class, array('label' => 'devenir bo'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();

            if ($em->getRepository('TesBoBundle:Users')->findOneByPseudo($form["pseudo"]->getData()))
                return $this->render('TesBoBundle:Default:register.html.twig', array('form' => $form->createView(),"error"=>"username ".$form["pseudo"]->getData()." already taken"));
            else if ($em->getRepository('TesBoBundle:Users')->findOneByEmail($form["email"]->getData()))
                return $this->render('TesBoBundle:Default:register.html.twig', array('form' => $form->createView(),"error"=>"email ".$form["email"]->getData()." already taken"));

            $user->setPassword(hash('sha256', $this->getParameter('salt').$form["password"]->getData()));
            $user->setRegisteredDatetime(new \DateTime());
            $user->setIsBanned(false);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('tes_bo_homepage');
        }


        return $this->render('TesBoBundle:Default:register.html.twig', array('form' => $form->createView()));
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
        else if ($user = "homepage")
        {
            return $this->render('TesBoBundle:Default:index.html.twig', array('user' => $user, "gallery" => $gallery));
        }
        else
            return $this->redirectToRoute('tes_bo_homepage');

    }
}
