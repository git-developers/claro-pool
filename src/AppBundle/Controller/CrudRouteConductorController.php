<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\Crud\Builder\CrudMapper;
use AppBundle\Services\Crud\Builder\DataTableMapper;
use AppBundle\Entity\Route;
use AppBundle\Entity\PasajeroHasRoute;

class CrudRouteConductorController extends BaseController
{


    public function index(CrudMapper $crudMapper, DataTableMapper $dataTable)
    {

        $user = $this->getUser();

        $crud = $crudMapper->getDefaults();
        $entity = $this->em()->getRepository($crud['class_path'])->findAllByUser($user->getId());
        $entity = $this->getSerialize($entity, $crud['group_name']);

        $dataTable->setData($entity);

        return $this->render(
            'AppBundle:CrudRouteConductor:index.html.twig',
            [
                'crud' => $crud,
                'dataTable' => $dataTable,
            ]
        );

    }
	
	public function misCarreras(CrudMapper $crudMapper, DataTableMapper $dataTable)
	{
		
		$user = $this->getUser();
		
		$crud = $crudMapper->getDefaults();
		$entities = $this->em()->getRepository($crud['class_path'])->misCarreras($user->getId());
		
		
		$out = [];
		
		foreach ($entities as $key => $entity) {
			
			$interval = '-';

			if ( !is_null($entity->getTimeStart()) && !is_null($entity->getTimeEnd()) ) {
				
				$date = clone $entity->getCreatedAt();
				
				//START
				$TSHour = $entity->getTimeStart()->format("H");
				$TSMinute = $entity->getTimeStart()->format("i");
				$TSSecond = $entity->getTimeStart()->format("s");
				
				$timeStart = clone $date;
				$timeStart->setTime($TSHour, $TSMinute, $TSSecond);
				
				//END
				$TEHour = $entity->getTimeEnd()->format("H");
				$TEMinute = $entity->getTimeEnd()->format("i");
				$TESecond = $entity->getTimeEnd()->format("s");
				
				$timeEnd = clone $date;
				$timeEnd->setTime($TEHour, $TEMinute, $TESecond);
				
				$interval = $timeStart->diff($timeEnd);
				$interval = $interval->format('%h horas con %i minutos y %s segundos'); // %y years %m months %a days
				
//				echo "POLLO:: <pre>";
//				print_r($interval);
//				print_r(" ************ ");
//				print_r($timeStart);
//				print_r(" ************ ");
//				print_r($timeEnd);

			}
			
			
			
			
			$out[$key]['id'] = $entity->getIdIncrement();
			$out[$key]['created_at'] = $entity->getCreatedAt()->format('Y-m-d');
			$out[$key]['trayectoria'] = $entity->getDistritFrom()->getName() . ' - ' . $entity->getDistritTo()->getName();
			$out[$key]['time_start'] = !is_null($entity->getTimeStart()) ? $entity->getTimeStart()->format('H:i') : '-';
			$out[$key]['time_end'] = !is_null($entity->getTimeEnd()) ? $entity->getTimeEnd()->format('H:i') : '-';
			$out[$key]['duracion'] = $interval;
		}

//		exit;
		
//		$entity = $this->getSerialize($entity, $crud['group_name']);
		
		$entities = json_encode($out);
		
//		echo "POLLO:: <pre>";
//		print_r($entities);
//		exit;

		
		$dataTable->setData($entities);
		
		return $this->render(
			'AppBundle:CrudRouteConductor:mis_carreras.html.twig',
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

    public function delete(Request $request, CrudMapper $crudMapper)
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

        try {


            if($entity){

                $entity->setStatus(Route::STATUS_ANULADO);
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

    public function empezarCarrera(Request $request, CrudMapper $crudMapper)
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

        try {


            if($entity){

                $entity->setStatus(Route::STATUS_EN_CURSO);
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

    public function finalizar(Request $request, CrudMapper $crudMapper)
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

        try {


            if($entity){

                $entity->setStatus(Route::STATUS_FINALIZADO);
                $entity->setTimeEnd(new \DateTime());
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
        $pasajeroHasRoute = $this->em()->getRepository(PasajeroHasRoute::class)->findByRoute($id);



//        echo "POLLO:: <pre>";
//        print_r($pasajeroHasRoute);
//        exit;



        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        return $this->render(
            $this->validateTemplate($crud['template_view']),
            [
                'entity' => $entity,
                'pasajeroHasRoute' => $pasajeroHasRoute,
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