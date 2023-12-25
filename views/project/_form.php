<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->radioList([1 => 'Active', 0 => 'Inactive']) ?>

    <?= $form->field($model, 'assigned_to')->dropDownList(User::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => 'Select User']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
