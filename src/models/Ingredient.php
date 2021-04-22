<?php

namespace sibus\food\models;

use sibus\food\models\queries\IngredientQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ingredients}}".
 *
 * @property int $id
 * @property string $name
 * @property int $is_hidden
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
     * {@inheritdoc}
     */
    public static function find(): IngredientQuery
    {
        return new IngredientQuery(get_called_class());
    }
}
