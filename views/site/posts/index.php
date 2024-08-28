<?php

/** @var yii\web\View $this */

$this->title = 'Posts';
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
                <?php if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('user')): ?>
                    <div class="page-title-actions">
                        <a href="/site/post-add" type="button" data-toggle="tooltip" title="Add User"
                           data-placement="bottom"
                           class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-plus"></i>
                        </a>
                        <button type="button" data-toggle="tooltip" title="Filter Post"
                           data-placement="bottom" onclick="comment()"
                           class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-2 card" style="display:none;" id="filterBox">
                    <div class="card-header"><span><?= \yii\helpers\Html::encode($this->title) ?> Filter</span>
                    </div>
                    <div class="card_body p-3">
                        <form action="<?= \yii\helpers\Url::to(['site/filter-post']) ?>" method="GET">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Post Title</label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $title ?? '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">User's</label>
                                <select class="form-control" name="user_id">
                                    <option>Select user</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user->id ?>">
                                            <?= htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary col-lg-6">Search</button> &nbsp;
                                <button type="button" class="btn btn-secondary col-lg-6" onclick="comment()">Close</button>
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
                                <th>Post Image</th>
                                <th>Title `User Name`</th>
                                <th>Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($posts as $post): ?>
                                <?php

                                $currentUserId = Yii::$app->user->identity->id;

                                $isAdmin = Yii::$app->authManager->getRolesByUser($currentUserId)['admin'] ?? false; ?>

                                <?php if ($isAdmin): ?>
                                    <tr>
                                        <td class="text-center text-muted">#<?= $post['id']; ?></td>
                                        <td class="text-muted">
                                            <img src="../posts/<?= $post['post_image']; ?>" style="height: 50px;"/>
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading"><?= $post['title']; ?></div>
                                                        <div class="widget-subheading opacity-7"><?= @$post->user->username ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted"><?= \yii\helpers\StringHelper::truncate($post['description'], 80) ?></td>
                                        <td class="text-center">
                                            <?php if (\Yii::$app->user->can('admin')): ?>
                                                <?= \yii\helpers\Html::a("Edit", ['post-edit', 'id' => $post->id], ['class' => 'btn btn-info']); ?>
                                                <?= \yii\helpers\Html::a("Delete", ['delete', 'id' => $post->id], ['class' => 'btn btn-danger']); ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php if (!Yii::$app->user->isGuest && $post->user_id == Yii::$app->user->identity->id): ?>
                                        <tr>
                                            <td class="text-center text-muted">#<?= $post['id']; ?></td>
                                            <td class="text-muted">
                                                <img src="../posts/<?= $post['post_image']; ?>" style="height: 50px;"/>
                                            </td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading"><?= $post['title']; ?></div>
                                                            <div class="widget-subheading opacity-7"><?= $post->user->username ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted"><?= \yii\helpers\StringHelper::truncate($post['description'], 80) ?></td>
                                            <td class="text-center">
                                                <?php if (\Yii::$app->user->can('admin')): ?>
                                                    <?= \yii\helpers\Html::a("Edit", ['post-edit', 'id' => $post->id], ['class' => 'btn btn-info']); ?>
                                                    <?= \yii\helpers\Html::a("Delete", ['delete', 'id' => $post->id], ['class' => 'btn btn-danger']); ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function comment() {
            const commentBox = document.getElementById('filterBox');

            if (commentBox.style.display == 'block') {
                commentBox.style.display = 'none';
            } else {
                commentBox.style.display = 'block';
            }

        }
    </script>
