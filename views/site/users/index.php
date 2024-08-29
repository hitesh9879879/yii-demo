<?php

/** @var yii\web\View $this */

$this->title = 'User';
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
                <div class="page-title-actions">
                    <a href="/site/user-add" type="button" data-toggle="tooltip" title="Add User" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"><?= \yii\helpers\Html::encode($this->title) ?>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="text-center text-muted"># <?= $user['id']; ?></td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading"><?= $user['username']; ?></div>
                                                <div class="widget-subheading opacity-7"><?= $user['email']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted"><?= $user['status'] == 1 ? 'Activate' : 'Deactivate' ?></td>
                                <td class="text-center"><?= \yii\helpers\Html::a("Edit", ['user-edit', 'id' => $user->id], ['class' => 'btn btn-info']); ?>  <?= \yii\helpers\Html::a("Delete", ['user-delete', 'id' => $user->id], ['class' => 'btn btn-danger']); ?> <?php if (\Yii::$app->user->can('admin')): ?> <?= \yii\helpers\Html::a("Update Role", ['role-update', 'id' => $user->id], ['class' => 'btn btn-dark']); ?> <?= \yii\helpers\Html::a("Change Status", ['change-status', 'id' => $user->id], ['class' => 'btn btn-dark']); ?> <?php endif;?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
