<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%horario_materia}}`.
 */
class m220725_202208_create_horario_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%horario_materia}}', [
            'id' => $this->primaryKey(),
            'id_materia' => $this->integer(),
            'id_reserva' => $this->integer(),
            'fh_desde' => $this->dateTime(),
            'fh_hasta' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-horario_materia-id_materia',
            '{{%horario_materia}}',
            'id_materia'
        );
        
        $this->addForeignKey(
            'fk_horario_materia_materia',
            '{{%horario_materia}}',
            'id_materia',
            '{{%materia}}',
            'id',
            'CASCADE'
        );
        
        $this->createIndex(
            'inx-horario_materia-id_reserva',
            '{{%horario_materia}}',
            'id_reserva'
        );

        $this->addForeignKey(
            'fk_materia_reserva',
            '{{%horario_materia}}',
            'id_reserva',
            '{{%reserva_aula}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_horario_materia_reserva',
            '{{%horario_materia}}'
        );

        $this->dropIndex(
            'inx-horario_materia-id_reserva',
            '{{%horario_materia}}'
        );

        $this->dropForeignKey(
            'fk_horario_materia_reserva',
            '{{%horario_materia}}'
        );

        $this->dropIndex(
            'inx-horario_materia-id_reserva',
            '{{%horario_materia}}'
        );

        $this->dropTable('{{%horario_materia}}');
    }
}
