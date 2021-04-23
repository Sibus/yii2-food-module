<?php

namespace sibus\food\models;

use sibus\food\models\queries\DishIngredientPivotQuery;
use sibus\food\models\queries\DishQuery;
use sibus\food\models\queries\IngredientQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%dish_ingredient}}".
 *
 * @property int $dish_id
 * @property int $ingredient_id
 *
 * @property Dish $dish
 * @property Ingredient $ingredient
 */
class DishIngredientPivot extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%dish_ingredient}}';
    }

    /**
     * Gets query for [[Dish]].
     *
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function getDish(): DishQuery
    {
        return $this->hasOne(Dish::class, ['id' => 'dish_id'])->inverseOf('dishIngredientPivots');
    }

    /**
     * Gets query for [[Ingredient]].
     *
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function getIngredient(): IngredientQuery
    {
        return $this->hasOne(Ingredient::class, ['id' => 'ingredient_id'])->inverseOf('dishIngredientPivots');
    }

    /**
     * {@inheritdoc}
     */
    public static function find(): DishIngredientPivotQuery
    {
        return new DishIngredientPivotQuery(get_called_class());
    }
}
