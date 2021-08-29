<?php
use yii\helpers\Html;
use yii\bootstrap\LinkPager;
use yii\helpers\ArrayHelper;
use app\models\Berita;
use app\models\Kategori;

$this->title = 'Kategori';
$this->params['breadcumbs'][] = $this->title;
?>

<div class="col-lg-8">
    <?php foreach ($berita as $tampil_beritan) : ?>
        <h2><?= Html::encode($tampil_beritan->judul) ?></h2>
        <span>
        <!-- menampilkan tanggal posting berita -->
        <strong>Tanggal : </strong><time><?= Html::encode($tampil_beritan->date) ?></time>
        &nbsp;&nbsp;&nbsp;
        <!-- menampilkan kategori berita -->
        <strong>Kategori : </strong>
        <?php  foreach($kategori as $kat) : 
        if ($tampil_beritan->id_category === $kat->id_category) {?>
        <?= Html::encode($kat->name_category) ?>
        <?php
        } 
        endforeach;?>
        &nbsp;&nbsp;&nbsp;
        <!-- menampilkan pennulis berita -->
        
        <strong>Penulis : </strong>
        <?php foreach ($users as $penulis) : 
        if ($tampil_beritan->username === $penulis->username) {?>
        <?= Html::encode($penulis->name) ?>
        <?php 
        } 
        endforeach;?>
    </span>
    <br>
    <!-- menampilkan gambar berita -->
    <img src="<?= Yii::$app->request->baseUrl.'/img_berita/'. $tampil_beritan->id_berita. '.' . $tampil_beritan->gambar?>" class="img-thumbnail">
    <!-- menampilkan isi berita -->
    <p align="justify"><?= Html::encode($tampil_beritan->isi_berita) ?></p>
    <div class="cleaner"></div>
    <?php endforeach;?>
    </div>

    <?php require_once Yii::$app->basePath . '../views/site/kategori.php';?>