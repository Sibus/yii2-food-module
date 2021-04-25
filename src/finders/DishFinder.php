<?php

namespace sibus\food\finders;

use sibus\food\models\Dish;
use sibus\food\models\DishIngredientPivot;
use sibus\food\models\Ingredient;
use sibus\food\models\queries\DishQuery;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * DishFinder represents the model behind the search form of `sibus\food\models\Dish`.
 */
class DishFinder extends Model
{
    const MIN_INGREDIENTS = 2;
    public $ingredient_1;
    public $ingredient_2;
    public $ingredient_3;
    public $ingredient_4;
    public $ingredient_5;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $attributes = ['ingredient_1', 'ingredient_2', 'ingredient_3', 'ingredient_4', 'ingredient_5'];

        return [
            [$attributes, 'integer'],
            // [
            //     $attributes,
            //     'exist',
            //     'targetClass' => Ingredient::class,
            //     'targetAttribute' => 'id',
            //     'filter' => ['is_hidden' => false],
            // ],
            [$attributes, function ($attribute) {
                if (count($this->getFilledIngredients()) < 2) {
                    $this->addError($attribute, 'Choose at least 2 ingredients');
                }
            }],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->load($params);

        if (!$this->validate()) {
            return new ActiveDataProvider([
                'query' => Dish::find()->emulateExecution(),
            ]);
        }

        $ingredients = $this->getFilledIngredients();

        if ($this->fullMatchQuery($ingredients)->exists()) {
            $query = $this->fullMatchQuery($ingredients);
        } else {
            $query = $this->partialMatchQuery($ingredients);
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function getIngredientList(): array
    {
        return Ingredient::find()
            ->select('name')
            ->active()
            ->indexBy('id')
            ->column();
    }

    /**
     * @param int[] $ingredients
     */
    private function query(array $ingredients): DishQuery
    {
        $subQuery = DishIngredientPivot::find()
            ->select(['dish_id', 'matches' => 'count(*)'])
            ->joinWith('ingredient')
            ->andWhere(['ingredient_id' => $ingredients])
            ->groupBy('dish_id');

        return ($q = Dish::find())
            ->select(['*'])
            ->innerJoin(['q' => $subQuery], "{$q->table}.id = q.dish_id")
            ->active()
            ->orderBy(['matches' => SORT_DESC]);
    }

    private function fullMatchQuery(array $ingredients): DishQuery
    {
        $query = $this->query($ingredients);

        ($allIngredientsCountQuery = DishIngredientPivot::find())
            ->select('count(*)')
            ->where("{$allIngredientsCountQuery->table}.dish_id={$query->table}.id")
            ->groupBy('dish_id');

        return $query
            ->andWhere(['matches' => count($ingredients)])
            ->having(['matches' => $allIngredientsCountQuery]);
    }

    private function partialMatchQuery(array $ingredients): DishQuery
    {
        return $this->query($ingredients)
            ->andWhere(['>=', 'matches', static::MIN_INGREDIENTS]);
    }

    public function looksFor($id): bool
    {
        return in_array($id, $this->getFilledIngredients());
    }

    /**
     * @return int[]
     */
    public function getFilledIngredients(): array
    {
        return array_filter([
            $this->ingredient_1,
            $this->ingredient_2,
            $this->ingredient_3,
            $this->ingredient_4,
            $this->ingredient_5,
        ]);
    }
}
