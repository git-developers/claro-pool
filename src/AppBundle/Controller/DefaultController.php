<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{

    public function indexAction(Request $request)
    {

        $user = $this->getUser();

        if($user){
            $url = $this->generateUrl('app_update_profile_edit', ['id' => $user->getId()]);
            return $this->redirect($url);
        }

        $url = $this->generateUrl('app_security_login');
        return $this->redirect($url);
    }

    /*

    /**
     * @Route("/", name="homepage")

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    */
}
