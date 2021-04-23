<?php

namespace sibus\food\models;

use sibus\food\models\queries\DishIngredientPivotQuery;
use sibus\food\models\queries\DishQuery;
use sibus\food\models\queries\IngredientQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ingredients}}".
 *
 * @property int $id
 * @property string $name
 * @property int $is_hidden
 * @property string $nameWithVisibilityMark
 *
 * @property Dish[] $dishes
 * @property DishIngredientPivot[] $dishIngredientPivots
 */
class Ingredient extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%ingredients}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['is_hidden'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_hidden' => 'Is Hidden',
        ];
    }

    /**
     * Gets query for [[Dishes]].
     *
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function getDishes(): DishQuery
    {
        return $this
            ->hasMany(Dish::class, ['id' => 'dish_id'])
            ->via('dishIngredientPivots');
    }

    /**
     * @noinspection PhpIncompatibleReturnTypeInspection
     */
    public function getDishIngredientPivots(): DishIngredientPivotQuery
    {
        return $this->hasMany(DishIngredientPivot::class, ['ingredient_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function find(): IngredientQuery
    {
        return new IngredientQuery(get_called_class());
    }

    public function isHidden(): bool
    {
        return (bool)$this->is_hidden;
    }

    public function getNameWithVisibilityMark(): string
    {
        $name = $this->name;

        if ($this->isHidden()) {
            $name .= ' [hidden]';
        }

        return $name;
    }
}
