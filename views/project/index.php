<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Projects';
?>

<div class="project-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            'created_at:datetime',
            'updated_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
