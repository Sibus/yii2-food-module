<?php

namespace sibus\food\models\queries;

/**
 * @property string table
 */
abstract class ActiveQuery extends \yii\db\ActiveQuery
{
    public function getTable(): string
    {
        return $this->getPrimaryTableName();
    }
}
