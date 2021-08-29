<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Berita */

$this->title = $model->id_berita;
$this->params['breadcrumbs'][] = ['label' => 'Berita', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="berita-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_berita' => $model->id_berita], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_berita' => $model->id_berita], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_berita',
            'id_category',
            [
                'label' => 'username',
                'value' => ($model->username),
            ],
            'judul',
            'headline',
            'isi_berita:ntext',
            [
                'label' => 'date',
                'value' => ($model->date),
            ],
            [
                'label' => 'gambar',
                'format' => 'raw',
                'value' => (Html::img(Yii::$app->request->baseUrl.'/img_berita/'.$model->id_berita.'.'.$model->gambar,['width' => '300px'])),
            ],
            [
                'label' => 'dibaca',
                'value' => ($model->dibaca),
            ],
        ],
    ]) ?>

</div>
