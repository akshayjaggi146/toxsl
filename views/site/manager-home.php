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
            'title',
            'description:ntext',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    // Use if condition to display role name based on the value
                    return ($model->status == 1) ? 'Active'  : 'Inactive';
                },
            ],
            [
                'attribute' => 'assigned_to',
                'value' => function ($model) {
                    return $model->user->name;
                },
            ],
            
        ],
    ]); ?>
</div>