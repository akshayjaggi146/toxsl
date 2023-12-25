<?php

use yii\grid\GridView;

$this->title = 'Admin Home';
?>

<div class="admin-home">
    <h1><?= $this->title ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'email',
            'created_at:datetime',
            'updated_at:datetime',
            // Additional columns as needed
        ],
    ]); ?>
</div>
