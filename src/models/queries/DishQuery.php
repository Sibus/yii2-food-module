<?php

namespace sibus\food\models\queries;

use sibus\food\models\Dish;

/**
 * This is the ActiveQuery class for [[Dish]].
 *
 * @see Dish
 */
class DishQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
