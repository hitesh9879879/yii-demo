<?php

namespace app\models;

use Yii;
use yii\base\BaseObject;
use yii\console\ExitCode;

class AddComment extends BaseObject implements \yii\queue\JobInterface
{
    public $count;

    public function execute($queue)
    {
        $posts = Post::find()->all();

        foreach ($posts as $com) {
            for ($i = 0; $i < $this->count; $i++) {
                Yii::$app->db->createCommand()->insert('comments', [
                    'post_id' => $com->id,
                    'user_id' => Yii::$app->user->identity->id ?? '1',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non egestas massa, sed pulvinar eros. Duis arcu quam, dapibus vel auctor vel, gravida sed est. Phasellus sapien augue, ultricies.',
                    'like' => 1,
                ])->execute();
            }
        }

        return ExitCode::OK;
    }
}
