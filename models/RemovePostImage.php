<?php

namespace app\models;

use Yii;
use yii\base\BaseObject;
use yii\console\ExitCode;

class RemovePostImage extends BaseObject implements \yii\queue\JobInterface
{
    public function execute($queue)
    {
        $imageFolder = realpath(__DIR__ . '/../web/posts');
        echo "Directory path: " . $imageFolder . "\n";

        $files = scandir($imageFolder);

        $imageFiles = array_diff($files, ['.', '..']);

        $posts = Post::find()->all();

        $postImages = [];

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $postImages[] = $post->post_image;
            }
        }

        foreach ($imageFiles as $file) {
            if (!in_array($file, $postImages)) {
                $filePath = $imageFolder . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    unlink($filePath);
                    echo "Deleted unmatched file: " . $file . "\n";
                }
            }
        }

        echo "Cleanup complete.";

        return ExitCode::OK;
    }
}