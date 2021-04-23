<?php

namespace sibus\food\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dish_ingredient}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%dishes}}`
 * - `{{%ingredients}}`
 */
class M210422092504CreateJunctionDishAndIngredientTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dish_ingredient}}', [
            'dish_id' => $this->integer(),
            'ingredient_id' => $this->integer(),
            'PRIMARY KEY(dish_id, ingredient_id)',
        ]);

        // creates index for column `dish_id`
        $this->createIndex(
            '{{%idx-dish_ingredient-dish_id}}',
            '{{%dish_ingredient}}',
            'dish_id'
        );

        // add foreign key for table `{{%dishes}}`
        $this->addForeignKey(
            '{{%fk-dish_ingredient-dish_id}}',
            '{{%dish_ingredient}}',
            'dish_id',
            '{{%dishes}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ingredient_id`
        $this->createIndex(
            '{{%idx-dish_ingredient-ingredient_id}}',
            '{{%dish_ingredient}}',
            'ingredient_id'
        );

        // add foreign key for table `{{%ingredients}}`
        $this->addForeignKey(
            '{{%fk-dish_ingredient-ingredient_id}}',
            '{{%dish_ingredient}}',
            'ingredient_id',
            '{{%ingredients}}',
            'id',
            'CASCADE'
        );
        $this->addCommentOnTable('{{%dish_ingredient}}', 'Связь блюд и ингредиентов');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%dishes}}`
        $this->dropForeignKey(
            '{{%fk-dish_ingredient-dish_id}}',
            '{{%dish_ingredient}}'
        );

        // drops index for column `dish_id`
        $this->dropIndex(
            '{{%idx-dish_ingredient-dish_id}}',
            '{{%dish_ingredient}}'
        );

        // drops foreign key for table `{{%ingredients}}`
        $this->dropForeignKey(
            '{{%fk-dish_ingredient-ingredient_id}}',
            '{{%dish_ingredient}}'
        );

        // drops index for column `ingredient_id`
        $this->dropIndex(
            '{{%idx-dish_ingredient-ingredient_id}}',
            '{{%dish_ingredient}}'
        );

        $this->dropTable('{{%dish_ingredient}}');
    }
}
