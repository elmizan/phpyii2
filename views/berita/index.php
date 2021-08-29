<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BeritaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Berita';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="berita-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Berita', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_berita',
            'id_category',
            //'username',
            'judul',
            'headline',
            'isi_berita:ntext',
            'date',
            'gambar',
            'dibaca',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model)
                    {
                        return Html::a('<i class="far fa-eye"></i>', ['view', 'id_berita' => $model->id_berita],);

                    },
                    'update' => function ($url, $model)
                    {
                        return Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id_berita' => $model->id_berita],);

                    },
                    'delete' => function ($url, $model)
                    {
                        return  Html::a('<i class="fas fa-trash"></i>', ['delete', 'id_berita' => $model->id_berita], 
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
