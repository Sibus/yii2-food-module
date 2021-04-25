<?php

namespace sibus\food\models\queries;

use sibus\food\models\Dish;
use sibus\food\models\Ingredient;

/**
 * This is the ActiveQuery class for [[Dish]].
 *
 * @see Dish
 */
class DishQuery extends ActiveQuery
{
    public function active(): DishQuery
    {
        $hiddenIngredients = Ingredient::find()
            ->joinWith(['dishIngredientPivots' => function (DishIngredientPivotQuery $query) {
                $query->andWhere("{$query->table}.dish_id = {$this->table}.id");
            }])
            ->hidden();

        return $this->andWhere(['NOT EXISTS', $hiddenIngredients]);
    }

    /**
     * {@inheritdoc}
     * @return Dish[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dish|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
