<?php

namespace AppBundle\Controller;

use AppBundle\Controller\CrudRouteConductorController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Route;
use AppBundle\Form\RouteType;
use AppBundle\Form\RouteConductorType;
use AppBundle\Services\Crud\Builder\CrudMapper;

class RouteConductorController extends CrudRouteConductorController {

    const CLASS_PATH = Route::class;
    const GROUP_NAME = 'route';
    const VIEW = 'Route';
    const FORM_TYPE = RouteType::class;
    const LIMIT_POINT_OF_SALE = 20;


    public function indexAction()
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $crudMapper
            ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('section_title', 'Gestionar rutas conductor')
            ->add('section_icon', 'home')
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('section_box_class', 'primary')
            ->add('route_empezar_carrera', $this->generateUrl('app_route_conductor_empezar_carrera'))
            ->add('route_finalizar', $this->generateUrl('app_route_conductor_finalizar'))
            ->add('route_create', $this->generateUrl('app_route_conductor_create'))
//            ->add('route_edit', $this->generateUrl('app_route_conductor_edit'))
            ->add('route_delete', $this->generateUrl('app_route_conductor_delete'))
            ->add('route_view', $this->generateUrl('app_route_conductor_view'))
            ->add('route_info', $this->generateUrl('app_route_conductor_info'))
            ->add('test', 'test', [
                'label' => '',
            ])
        ;

        $dataTable
            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
//            ->addColumn('image', " '<img src=\"' + obj.image + '\" class=\"img-responsive\" style=\"max-height: 50px\" >' ")
//            ->addColumn('Code', " '<small class=\"label label-success\">' + obj.code + '</small>' ")
            ->addColumn('Descripcion', 'obj.description')
            ->addColumn('Start', " '<span class=\"badge bg-blue\">' + obj.distrit_from.name + '</span>' ", [
                'icon' => 'map-marker'
            ])
            ->addColumn('End', " '<span class=\"badge bg-blue\">' + obj.distrit_to.name + '</span>' ", [
                'icon' => 'map-marker'
            ])
//            ->addColumn('Start', " '<span class=\"badge bg-blue\">' + obj.latitude_start + ' - ' + obj.longitude_start + '</span>' ", [
//                'icon' => 'map-marker'
//            ])
//            ->addColumn('End', " '<span class=\"badge bg-blue\">' + obj.latitude_end + ' - ' + obj.longitude_end + '</span>' ", [
//                'icon' => 'map-marker'
//            ])
            ->addColumn('Nro asientos', 'obj.nro_of_seats')
            ->addColumn('Creado', 'obj.created_at', [
                'icon' => 'calendar'
            ])
            ->addColumn('Estado', " '<span class=\"badge\">' + obj.status + '</span>' ")
            ->addButtonTableRouteConductor(['edit', 'delete', 'empezarCarrera', 'finalizar'], 'obj.id_increment')
            ->addButtonHeader(['create', 'info'])
            ->addRowCallBack('id', 'aData.id_increment')
            ->addRowCallBack('data-id', 'aData.id_increment')
            ->addRowCallBack('class', ' "alert" ')
        ;

        return parent::index($crudMapper, $dataTable);

    }

    public function createAction(Request $request)
    {

        $entity = new Route();

        if (!$entity) {
            throw $this->createNotFoundException('UpdateProfile: Unable to find  entity.');
        }

        $form = $this->createForm(RouteConductorType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();

            $entity->setConductorId($user->getId());
            $entity->setStatus(Route::STATUS_CREADO);
            $this->persist($entity);

            $this->flashSuccess('Info: creado con exito');
            $url = $this->generateUrl('app_route_conductor_index');
            return $this->redirect($url);
        }

        return $this->render(
            'AppBundle:CrudRouteConductor:form.html.twig',
            [
                'formEntity' => $form->createView(),
                'action' => 'Crear',
            ]
        );
    }

    public function editAction(Request $request)
    {
        $id = $request->get('id');

        if (!$id) {
            throw $this->createNotFoundException('CrudRouteConductor: id required.');
        }

        $entity = $this->em()->getRepository(Route::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('CrudRouteConductor: Unable to find  entity.');
        }

        $form = $this->createForm(RouteConductorType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persist($entity);
        }

        return $this->render(
            'AppBundle:CrudRouteConductor:form.html.twig',
            [
                'formEntity' => $form->createView(),
                'id' => $id,
                'action' => 'Editar',
            ]
        );
    }

    public function misCarrerasAction(Request $request)
    {
	    $crud = $this->get('app.service.crud');
	    $crudMapper = $crud->getCrudMapper();
	    $dataTable = $crud->getDataTableMapper();
	
	    $crudMapper
		    ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
		    ->add('section_title', 'Mis carreras')
		    ->add('section_icon', 'cab')
		    ->add('class_path', self::CLASS_PATH)
		    ->add('group_name', self::GROUP_NAME)
		    ->add('section_box_class', 'primary')
		    ->add('route_view', $this->generateUrl('app_route_conductor_view'))
		    ->add('route_info', $this->generateUrl('app_route_conductor_info'))
		    ->add('test', 'test', [
			    'label' => '',
		    ])
	    ;
	
	    $dataTable
		    ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id + '</span>' ")
		    ->addColumn('Fecha', 'obj.created_at', [
			    'icon' => 'calendar'
		    ])
//		    ->addColumn('Descripcion', 'obj.description')
		    ->addColumn('Trayectoria', " '<span class=\"badge bg-blue\">' + obj.trayectoria + '</span>' ", [
			    'icon' => 'map-marker'
		    ])
		    ->addColumn('Hora inicio', 'obj.time_start')
		    ->addColumn('Hora fin', 'obj.time_end')
		    ->addColumn('Duración', " '<span class=\"badge bg-blue\">' + obj.duracion + '</span>' ", [
			    'icon' => 'clock-o'
		    ])
//		    ->addColumn('Estado', " '<span class=\"badge\">' + obj.status + '</span>' ")
//		    ->addButtonTableRouteConductor(['edit', 'delete', 'empezarCarrera', 'finalizar'], 'obj.id_increment')
//		    ->addButtonHeader(['create', 'info'])
		    ->addButtonHeader(['info'])
		    ->addRowCallBack('id', 'aData.id')
		    ->addRowCallBack('data-id', 'aData.id')
		    ->addRowCallBack('class', ' "alert" ')
	    ;
	
	    return parent::misCarreras($crudMapper, $dataTable);
    }

    public function deleteAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::delete($request, $crudMapper);
    }

    public function empezarCarreraAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::empezarCarrera($request, $crudMapper);
    }

    public function finalizarAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::finalizar($request, $crudMapper);
    }

    public function infoAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('template_info', $this->getInformativeTemplate(self::VIEW, 'info'))
        ;

        return parent::info($request, $crudMapper);
    }

    public function viewAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('template_view', $this->getInformativeTemplate(self::VIEW, 'view'))
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::view($request, $crudMapper);
    }


}
