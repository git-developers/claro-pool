<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Crud\Builder\CrudMapper;
use AppBundle\Services\Crud\Builder\DataTableMapper;
use AppBundle\Entity\Route;
use AppBundle\Form\RoutePasajeroType;

class CrudRoutePasajeroController extends BaseController
{

    public function index(CrudMapper $crudMapper, DataTableMapper $dataTable)
    {
        $crud = $crudMapper->getDefaults();
        $entity = $this->em()->getRepository($crud['class_path'])->findAllRoutePasajero();
        $entity = $this->getSerialize($entity, $crud['group_name']);

        $dataTable->setData($entity);

        return $this->render(
            'AppBundle:CrudRoutePasajero:index.html.twig',
            [
                'crud' => $crud,
                'dataTable' => $dataTable,
            ]
        );

    }

    public function create(Request $request, CrudMapper $crudMapper)
    {
        $crud = $crudMapper->getDefaults();
        $entity = new $crud['entity']();

        if (!$this->isXmlHttpRequest($request) && !is_object($entity)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $form = $this->createForm($crud['form_type'], $entity, $crud['form_attr']);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $crud['group_name']);
                    $status = self::AJAX_STATUS_SUCCESS;
                }else{
                    foreach ($form->getErrors(true) as $key => $error) {
                        if ($form->isRoot()) {
                            $errors[] = $error->getMessage();
                        } else {
                            $errors[] = $error->getMessage();
                        }
                    }
                }

            }catch (\Exception $e){
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'status' => $status,
                'errors' => $errors,
                'entity' => $entityJson,
            ]);
        }

        return $this->render(
            $this->validateTemplate($crud['template_create']),
            [
                'formEntity' => $form->createView(),
                'crud' => $crud,
            ]
        );
    }

    public function edit(Request $request, CrudMapper $crudMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $id = $request->get('id');
        $crud = $crudMapper->getDefaults();
        $entity = $this->em()->getRepository($crud['class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        $form = $this->createForm($crud['form_type'], $entity, $crud['form_attr']);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $crud['group_name']);
                    $status = self::AJAX_STATUS_SUCCESS;
                }else{
                    foreach ($form->getErrors(true) as $key => $error) {
                        if ($form->isRoot()) {
                            $errors[] = $error->getMessage();
                        } else {
                            $errors[] = $error->getMessage();
                        }
                    }
                }

            }catch (\Exception $e){
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'status' => $status,
                'errors' => $errors,
                'entity' => $entityJson,
                'id' => $id,
            ]);
        }

        return $this->render(
            $this->validateTemplate($crud['template_edit']),
            [
                'formEntity' => $form->createView(),
                'crud' => $crud,
                'id' => $id,
            ]
        );
    }

    public function solicitarCarrera(Request $request, CrudMapper $crudMapper)
    {

        $id = $request->get('id');

        if (!$id) {
            throw $this->createNotFoundException('CrudRoutePasajero: id required.');
        }

        $entity = $this->em()->getRepository(Route::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('CrudRoutePasajero: Unable to find  entity.');
        }

        $form = $this->createForm(RoutePasajeroType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $this->persist($entity);

            echo '<pre> POLLO:: ';
            print_r($entity->getNroOfSeats());
            exit;


        }

        return $this->render(
            'AppBundle:CrudRoutePasajero:form.html.twig',
            [
                'formEntity' => $form->createView(),
                'entity' => $entity,
                'id' => $id,
            ]
        );
    }

    public function unSolicitarCarrera(Request $request, CrudMapper $crudMapper)
    {
        if (!$this->isXmlHttpRequest($request)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        $id = $request->get('id');
        $crud = $crudMapper->getDefaults();
        $repository = $this->em()->getRepository($crud['class_path']);
        $entity = $repository->find($id);
        $user = $this->getUser();

        try {


            if($entity && $user){

                $entity->removeUser($user);
//                $entity->setIsActive(false);
//                $this->remove($entity);
                $this->persist($entity);
                $entityJson = $this->getSerializeDecode($entity, $crud['group_name']);

                $status = self::AJAX_STATUS_SUCCESS;
            }

        }catch (\Exception $e){
            $errors[] = $e->getMessage();
        }

        return $this->json([
            'status' => $status,
            'errors' => $errors,
            'entity' => $entityJson,
            'id' => $id,
        ]);
    }

    public function view(Request $request, CrudMapper $crudMapper)
    {
        if (!$this->isXmlHttpRequest($request)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $id = $request->get('id');
        $crud = $crudMapper->getDefaults();
        $entity = $this->em()->getRepository($crud['class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        return $this->render(
            $this->validateTemplate($crud['template_view']),
            [
                'entity' => $entity,
            ]
        );
    }

    public function info(Request $request, CrudMapper $crudMapper)
    {
        if (!$this->isXmlHttpRequest($request)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $crud = $crudMapper->getDefaults();

        return $this->render(
            $this->validateTemplate($crud['template_info']),
            [
                'xxx' => '',
            ]
        );
    }

    protected function getFormTemplate($view, $form = 'form')
    {
        $bundle = $this->getBundleName();
        return $bundle . ':' . $view . ':Form/' . $form . '.html.twig';
    }

    protected function getInformativeTemplate($view, $action)
    {
        $bundle = $this->getBundleName();
        return $bundle . ':' . $view . ':Informative/' . strtolower($action) . '.html.twig';
    }

}