<?php

namespace sibus\food\models\queries;

use sibus\food\models\DishIngredientPivot;

/**
 * This is the ActiveQuery class for [[DishIngredientPivot]].
 *
 * @see DishIngredientPivot
 */
class DishIngredientPivotQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return DishIngredientPivot[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DishIngredientPivot|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
