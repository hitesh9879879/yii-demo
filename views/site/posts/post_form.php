<?php

/** @var yii\web\View $this */

$this->title = $post->isNewRecord ? 'Post Add' : 'Post Edit';
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car fa fa-clipboard"></i>
                    </div>
                    <div><?= \yii\helpers\Html::encode($this->title) ?>
                        <div class="page-title-subheading">This is an example dashboard created using build-in
                            elements and components.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"><?= \yii\helpers\Html::encode($this->title) ?>
                    </div>
                    <div class="p-4">
                        <?php $form = \yii\widgets\ActiveForm::begin([
                            'id' => 'login-form',
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{error}",
                                'labelOptions' => ['class' => 'col-form-label'],
                                'inputOptions' => ['class' => 'form-control'],
                                'errorOptions' => ['class' => 'invalid-feedback'],
                            ],
                        ]); ?>

                        <?php
                            $currentUserId = Yii::$app->user->identity->id;

                            $isAdmin = Yii::$app->authManager->getRolesByUser($currentUserId)['admin'] ?? false;

                            if ($isAdmin) {
                                $items_array = \yii\helpers\ArrayHelper::map(\app\models\User::find()->asArray()->all(), 'id', 'username');
                            } else {
                                $items_array = \yii\helpers\ArrayHelper::map(\app\models\User::find()->where(['id' => $currentUserId])->asArray()->all(), 'id', 'username');
                            }
                        ?>

                        <?= $form->field($post, 'user_id')->dropDownList($items_array, ['prompt' => 'Select Any One', 'data-height' => "45"]); ?>

                        <?= $form->field($post, 'title')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($post, 'description')->textarea() ?>

                        <?= $form->field($post, 'post_image')->fileInput() ?>

                        <div class="form-group">
                            <?= \yii\helpers\Html::submitButton($post->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary btn-block']); ?>
                        </div>

                        <?php \yii\widgets\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
