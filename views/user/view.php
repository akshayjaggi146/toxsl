<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
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
    ],
]) ?>
