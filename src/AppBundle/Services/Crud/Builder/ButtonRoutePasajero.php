<?php

namespace AppBundle\Services\Crud\Builder;

class ButtonRoutePasajero
{
    const TEST = 'test';

    protected $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function solicitarCarrera()
    {
        $attr = [
            'class' => 'btn btn-success btn-xs ' . CrudMapper::MODAL_SOLICITAR_CARRERA_ID,
            'alt' => 'Solicitar Carrera',
            'title' => 'Solicitar Carrera',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_SOLICITAR_CARRERA_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-random"></i> Solicitar Carrera</button>';

        return $out;
    }

    public function unSolicitarCarrera()
    {
        $attr = [
                'class' => 'btn btn-danger btn-xs ' . CrudMapper::MODAL_UNSOLICITAR_CARRERA_ID,
            'alt' => 'Anular Carrera',
            'title' => 'Anular Carrera',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_UNSOLICITAR_CARRERA_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-trash"></i> Anular Carrera</button>';

        return $out;
    }

    public function edit()
    {
        $attr = [
            'class' => 'btn btn-warning btn-xs ' . CrudMapper::MODAL_EDIT_ID,
            'alt' => 'Editar',
            'title' => 'Editar',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_EDIT_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-pencil"></i></button>';

        return $out;
    }

    public function delete()
    {
        $attr = [
            'class' => 'btn btn-danger btn-xs ' . CrudMapper::MODAL_DELETE_ID,
            'alt' => 'Eliminar',
            'title' => 'Eliminar',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_DELETE_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-trash"></i> anular</button>';

        return $out;
    }

    public function create()
    {
        $attr = [
            'class' => 'btn btn-success btn-xs ' . CrudMapper::MODAL_CREATE_ID,
            'alt' => 'Crear item',
            'title' => 'Crear item',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_CREATE_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-fw fa-plus"></i> crear item</button>';

        return $out;
    }

    public function info()
    {
        $attr = [
            'class' => 'btn btn-info btn-xs ' . CrudMapper::MODAL_INFO_ID,
            'alt' => 'Info',
            'title' => 'Info',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_INFO_ID,
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-fw fa-info-circle"></i> info</button>';

        return $out;
    }

}



