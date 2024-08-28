<?php
namespace app\models;

use yii\db\ActiveRecord;

class ExcelData extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%excels}}';
    }

    public function rules()
    {
        return [
            [['file_name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['file_name'], 'string', 'max' => 255],
        ];
    }

}
