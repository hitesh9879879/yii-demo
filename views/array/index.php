<?php

/** @var yii\web\View $this */

/** @var array $data */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Array Data';
?>
<div class="app-main__outer <?= \Yii::$app->user->can('user') ? 'p-5 mt-5' : '' ?>">
    <div class="app-main__inner">
        <div class="card">
            <div class="card-body">
                <?= Html::beginForm(Url::to(['array/index']), 'GET', ['id' => 'count']) ?>
                <div class="d-flex justify-content-center">
                    <?php
                        $db = \Yii::$app->db;
                        $tables = $db->schema->getTableNames();
                        $tableName = [];

                        foreach ($tables as $table) {
                            $formattedName = ucwords(str_replace('_', ' ', $table));
                            $tableName[$table] = $formattedName;
                        }
                    ?>
                    <?= Html::dropDownList('model', $model, [
                            '' => 'Select Model Name',
                        ] + $tableName, ['class' => 'form-control'])
                    ?>
                    &nbsp;
                    <?= Html::input('number', 'count', $count, [
                        'class' => 'form-control',
                        'placeholder' => 'Count',
                        'autofill' => 'off'
                    ]) ?>
                    &nbsp;
                    <?= Html::submitButton('<i class="nav-link-icon fa fa-check"></i>', ['class' => 'btn btn-dark']) ?>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" style="width: 300px">
                        <div class="<?= !empty($data) ? '' : 'text-center' ?>">
                            <?php if (!empty($data)): ?>
                                <b><i>
                                        <pre><h5><?php print_r('Data Count : ' . $pageDataCount); ?></h5> <?php print_r($data); ?></pre>
                                    </i></b>
                            <?php else: ?>
                                <p><b><i>No data available.</i></b></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
