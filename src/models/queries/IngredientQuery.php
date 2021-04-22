<?php

namespace sibus\food\models\queries;

use sibus\food\models\Ingredient;

/**
 * This is the ActiveQuery class for [[Ingredient]].
 *
 * @see Ingredient
 */
class IngredientQuery extends ActiveQuery
{
    public function active(): IngredientQuery
    {
        return $this->andWhere(["{$this->table}.is_hidden" => false]);
    }

    public function hidden(): IngredientQuery
    {
        return $this->andWhere(["{$this->table}.is_hidden" => true]);
    }

    /**
     * {@inheritdoc}
     * @return Ingredient[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ingredient|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
