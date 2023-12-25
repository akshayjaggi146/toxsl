<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\models\User;

use app\models\LoginForm;

use yii\helpers\Url;

// ...

if (Yii::$app->user->isGuest) {
    $model = new LoginForm();
    return Yii::$app->getResponse()->redirect(Url::to(['site/login']));
}

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
            <h2>Assignment</h2>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <?= Html::a('Home', ['site/index'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?= Html::a('Projects', ['project/index'], ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                   
                     <form action = '/site/logout' method="post">
                     <input type="hidden" name="_csrf" value="_-XM_aMKgap_faMCb1A7Vfh7-IjwRnckkW3pFAZFYASvrbiLyCf48glFk1tbZXAjshWJ0cg2QHvZHZBVMjEoMA==">
                         <div class="form-group">
                             <?= Html::submitButton('logout', ['class' => 'btn btn-success logout']) ?>
                         </div>
                     </form>   

                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </main>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
