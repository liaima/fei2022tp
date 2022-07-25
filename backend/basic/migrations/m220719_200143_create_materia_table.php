<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%materia}}`.
 */
class m220719_200143_create_materia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%materia}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(128)->notNull(),
            'cant_alumnos' => $this->integer()->defaultValue(5),
            'id_carrera' => $this->integer(),
            'id_profesor' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-materia-id_carrera',
            '{{%materia}}',
            'id_carrera'
        );
        
        $this->addForeignKey(
            'fk_materia_carrera',
            '{{%materia}}',
            'id_carrera',
            '{{%carrera}}',
            'id',
            'CASCADE'
        );
        
        $this->createIndex(
            'inx-materia-id_profesor',
            '{{%materia}}',
            'id_profesor'
        );

        $this->addForeignKey(
            'fk_materia_profesor',
            '{{%materia}}',
            'id_profesor',
            '{{%profesor}}',
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
            'fk_materia_profesor',
            '{{%materia}}'
        );

        $this->dropIndex(
            'inx-materia-id_profesor',
            '{{%materia}}'
        );

        $this->dropForeignKey(
            'fk_materia_carrera',
            '{{%materia}}'
        );

        $this->dropIndex(
            'inx-materia-id_carrera',
            '{{%materia}}'
        );

        $this->dropTable('{{%materia}}');
    }
}
