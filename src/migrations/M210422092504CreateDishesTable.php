<?php

namespace sibus\food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dishes}}`.
 */
class M210422092504CreateDishesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dishes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);
        $this->addCommentOnTable('{{%dishes}}', 'Таблица блюд');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dishes}}');
    }
}
