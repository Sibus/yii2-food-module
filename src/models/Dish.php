<?php

namespace sibus\food\models;

use sibus\food\models\queries\DishIngredientPivotQuery;
use sibus\food\models\queries\DishQuery;
use sibus\food\models\queries\IngredientQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%dishes}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Ingredient[] $ingredients
 * @property DishIngredientPivot[] $dishIngredientPivots
 */
class Dish extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%dishes}}';
    }

    /**
     * Gets query for [[Ingredients]].
     *
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function getIngredients(): IngredientQuery
    {
        return $this
            ->hasMany(Ingredient::class, ['id' => 'ingredient_id'])
            ->via('dishIngredientPivots');
    }

    /**
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function getDishIngredientPivots(): DishIngredientPivotQuery
    {
        return $this->hasMany(DishIngredientPivot::class, ['dish_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function find(): DishQuery
    {
        return new DishQuery(get_called_class());
    }
}
