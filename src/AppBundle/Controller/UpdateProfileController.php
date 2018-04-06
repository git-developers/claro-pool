<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use AppBundle\Form\UpdateProfileType;


class UpdateProfileController extends BaseController
{

    public function editAction(Request $request)
    {

        $id = $request->get('id');

        if (!$id) {
            throw $this->createNotFoundException('UpdateProfile: user id required.');
        }

        $entity = $this->em()->getRepository(User::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('UpdateProfile: Unable to find  entity.');
        }

        $form = $this->createForm(UpdateProfileType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persist($entity);


            if ( in_array(Role::ROLE_CONDUCTOR, $entity->getRoles()) ) {

                $url = $this->generateUrl('app_route_conductor_index');

            } elseif ( in_array(Role::ROLE_PASAJERO, $entity->getRoles()) ){

                $url = $this->generateUrl('app_route_pasajero_index');

            }

            return $this->redirect($url);
        }

        return $this->render(
            'AppBundle:UpdateProfile:form.html.twig',
            [
                'formEntity' => $form->createView(),
                'id' => $id,
            ]
        );
    }

}

