<?php

namespace app\models;

use Yii;
use yii\base\BaseObject;
use yii\console\ExitCode;

class RemovePost extends BaseObject implements \yii\queue\JobInterface
{
    public function execute($queue)
    {
        $comments = Comment::find()->all();

        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $comment->delete();
            }
        }

        return ExitCode::OK;
    }
}