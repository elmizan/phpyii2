<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kategori', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_category',
            'name_category',
            'active',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model)
                    {
                        return Html::a('<i class="far fa-eye"></i>', ['view', 'id_category' => $model->id_category],);

                    },
                    'update' => function ($url, $model)
                    {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id_category' => $model->id_category],);

                    },
                    'delete' => function ($url, $model)
                    {
                        return  Html::a('<i class="fas fa-trash"></i>', ['delete', 'id_category' => $model->id_category], 
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
