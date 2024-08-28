<?php

/** @var yii\web\View $this */

$this->title = $user->isNewRecord ? 'User Add' : 'User Edit';
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car fa fa-user"></i>
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

                        <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($user, 'email')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($user, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <?= \yii\helpers\Html::submitButton($user->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary btn-block']); ?>
                        </div>

                        <?php \yii\widgets\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
