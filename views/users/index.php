<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            'username',
            'password',
            //'authKey',
            //'accessToken',
            //'role',
            'name',
            'email:email',
            'phone',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model)
                    {
                        return Html::a('<i class="far fa-eye"></i>', ['view', 'user_id' => $model->user_id],);

                    },
                    'update' => function ($url, $model)
                    {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'user_id' => $model->user_id],);

                    },
                    'delete' => function ($url, $model)
                    {
                        return  Html::a('<i class="fas fa-trash"></i>', ['delete', 'user_id' => $model->user_id], 
                        [
                            'data' => 
                            [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);

                    },
                ],
            ],
        ],
    ]); ?>
</div>
