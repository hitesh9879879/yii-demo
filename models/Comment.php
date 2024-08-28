<?php
namespace app\models;

use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%comments}}';
    }

    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

}
