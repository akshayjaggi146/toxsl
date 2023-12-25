
<?php
use yii\helpers\Html;
$this->title = 'User Home';
?>

<div class="user-home">
    <h1><?= $this->title ?></h1>

    <p>Welcome, <?= Yii::$app->user->identity->name ?>!</p>
    <!-- Additional content for user home page -->
</div>
