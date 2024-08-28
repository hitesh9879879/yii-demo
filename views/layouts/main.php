<?php if (\Yii::$app->user->can('user')): ?>
    <?php echo $this->render('frontend', ['content' => $content]); ?>
<?php else: ?>
    <?php echo $this->render('backend', ['content' => $content]); ?>
<?php endif; ?>