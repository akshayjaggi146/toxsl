<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Users';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'email',
        [
            'attribute' => 'role',
            'value' => function ($model) {
                // Use if condition to display role name based on the value
                return ($model->role == 1) ? 'Admin' : (($model->role == 2) ? 'Manager' : 'User');
            },
        ],
        [
            'attribute' => 'status',
            'value' => function ($model) {
                // Use if condition to display role name based on the value
                return ($model->status == 1) ? 'Active'  : 'Inactive';
            },
        ],
        'created_at:datetime',
        'updated_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
        ],
    ],
]); ?>
