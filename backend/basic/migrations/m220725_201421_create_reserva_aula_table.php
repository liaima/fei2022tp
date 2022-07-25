<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reserva_aula}}`.
 */
class m220725_201421_create_reserva_aula_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reserva_aula}}', [
            'id' => $this->primaryKey(),
            'id_aula' => $this->integer(),
            'fh_desde' => $this->dateTime(),
            'fh_hasta' => $this->dateTime(),
            'observacion' => $this->text(256),
        ]);

        $this->createIndex(
            'idx-reserva_aula-id_aula',
            '{{%reserva_aula}}',
            'id_aula'
        );
        
        $this->addForeignKey(
            'fk_reserva_aula_aula',
            '{{%reserva_aula}}',
            'id_aula',
            '{{%aula}}',
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
            'fk_reserva_aula_aula',
            '{{%reserva_aula}}'
        );

        $this->dropIndex(
            'inx-reserva_aula-id_aula',
            '{{%reserva_aula}}'
        );

        $this->dropTable('{{%reserva_aula}}');
    }
}
