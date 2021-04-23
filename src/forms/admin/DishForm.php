<?php

namespace sibus\food\forms\admin;

use sibus\food\models\Dish;
use sibus\food\models\Ingredient;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DishForm extends Model
{
    public $name;
    public $ingredients;
    private $dish;

    public function __construct(Dish $dish = null, $config = [])
    {
        parent::__construct($config);

        if ($dish) {
            $this->name = $dish->name;
            $this->ingredients = $dish->getIngredients()->select('id')->column();
            $this->dish = $dish;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
            ['name', 'unique', 'targetClass' => Dish::class, 'filter' => $this->dish ? ['<>', 'id', $this->dish->id] : null],
            ['ingredients', 'required'],
            ['ingredients', 'each', 'rule' => ['integer']],
            [
                'ingredients',
                'each',
                'rule' => [
                    'exist',
                    'targetClass' => Ingredient::class,
                    'targetAttribute' => 'id',
                    'filter' => ['is_hidden' => false],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getIngredients(): array
    {
        return ArrayHelper::map(
            Ingredient::find()->all(),
            'id',
            function (Ingredient $ingredient) { return $ingredient->getNameWithVisibilityMark(); }
        );
    }
}
