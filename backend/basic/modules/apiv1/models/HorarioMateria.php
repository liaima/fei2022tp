<?php

namespace app\modules\apiv1\models;


class HorarioMateria extends \app\models\HorarioMateria
{
    public function fields(){
        return [
            'id',
            'id_materia',
            'id_reserva',
            'fh_desde',
            'fh_hasta',
            'materia',
            'reserva',
            'aulaDescripcion' => function(){ return $this->reserva->aula->descripcion; }
        ];
    }

}
