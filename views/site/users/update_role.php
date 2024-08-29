<?php

/** @var yii\web\View $this */

$this->title = 'User Role Update';
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
                        <form action="<?= \yii\helpers\Url::to(['site/role-change']) ?>" method="GET">
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">User Email</label>
                                    <input type="text" name="email" readonly class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" value="<?= htmlspecialchars($user->email ?? '') ?>">
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">New Role</label>
                                    <select name="role" class="form-control">
                                        <option value="0">Select Role</option>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= htmlspecialchars($role['name']) ?>"
                                                <?= ($role['name'] == $user->role->item_name) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($role['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary col-lg-12">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
