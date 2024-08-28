<?php

/** @var yii\web\View $this */

$this->title = 'ExcelData Generator';
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
                <div class="main-card mb-2 card">
                    <div class="card-header"><span><?= \yii\helpers\Html::encode($this->title) ?> Filter</span>
                    </div>
                    <div class="card_body p-3">
                        <form action="<?= \yii\helpers\Url::to(['excel/index']) ?>" method="GET">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">File Name</label>
                                <input type="text" name="file_name" class="form-control" id="exampleInputEmail1"
                                       autocomplete="off" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3"><?php
                                $db = \Yii::$app->db;
                                $tables = $db->schema->getTableNames();
                                $tableName = [];

                                foreach ($tables as $table) {
                                    $formattedName = ucwords(str_replace('_', ' ', $table));
                                    $tableName[$table] = $formattedName;
                                }
                                ?>
                                <?= \yii\helpers\Html::dropDownList('model', '', [
                                        '' => 'Select Model Name',
                                    ] + $tableName, ['class' => 'form-control'])
                                ?>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit"
                                        class="btn btn-primary col-lg-12"><?= \yii\helpers\Html::encode($this->title) ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-header"><?= \yii\helpers\Html::encode($this->title) ?>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th>File Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($excelData as $excel): ?>
                                <tr>
                                    <td class="text-center text-muted"><b>#<?= $excel['id']; ?></b></td>
                                    <td class="text-muted"><b><?= $excel['file_name']; ?></b></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
