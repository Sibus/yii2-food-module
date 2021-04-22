<?php

namespace sibus\food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredients}}`.
 */
class M210422092503CreateIngredientsTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'is_hidden' => $this->boolean()->defaultValue(0)->notNull(),
        ]);
        $this->addCommentOnTable('{{%ingredients}}', 'Таблица ингредиентов');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ingredients}}');
    }
}
