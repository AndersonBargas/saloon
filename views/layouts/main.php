<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->name ?> :: <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $itensMenu = [];
    if (Yii::$app->user->isGuest) {
        $itensMenu[] = ['label' => 'Home', 'url' => ['/site/index']];
        $itensMenu[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $session = Yii::$app->session;
        $data = $session->get('data');

        

        //if (Yii::$app->user->identity->administrador) {
            $itensMenu[] = ['label' => 'Administração',
                            'items' => [
                                            ['label' => 'Cadastro', 
                                             'items' => [
                                                            ['label' => 'Acesso',  'url' => ['/site/index']],
                                                            ['label' => 'Empresa', 'url' => ['/site/index']],
                                                            ['label' => 'Perfil',  'url' => ['/site/index']],
                                                            ['label' => 'Usuário', 'url' => ['/usuarios/index']]
                                                        ],
                                            ],
                                        ]
                            ];

            $itensMenu[] = ['label' => 'Comissões',
                            'items' => [
                                            ['label' => 'Cadastro', 
                                             'items' => [
                                                            ['label' => 'Cliente', 'url' => ['/cliente/index']],
                                                            ['label' => 'Função',  'url' => ['/site/index']],
                                                            ['label' => 'Tabela',  'url' => ['/site/index']]
                                                        ],
                                            ],

                                            ['label' => 'Relatório', 
                                             'items' => [
                                                            ['label' => 'Importação', 'url' => ['/site/index']],
                                                            ['label' => 'Imprimir',   'url' => ['/site/index']]
                                                        ],
                                            ],

                                            ['label' => 'Dashboard', 'url' => ['/site/index'], 
                                             'items' => [],
                                            ],
                                        ]
                            ];
        //}
        $itensMenu[] = ['label' => 'Logout (' . Yii::$app->user->identity->getPrimeiroNome() . ')', 'url' => ['/site/logout']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $itensMenu,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
