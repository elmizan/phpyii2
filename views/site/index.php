<?php
use yii\helpers\Html;
use yii\bootstrap4\LinkPager;
use yii\helpers\ArrayHelper;
use app\models\Kategori;
use app\models\Berita;

/* @var $this yii\web\View */

$this->title = 'ElMizan CV';
?>
<!-- <div class="site-index"> -->

    <!-- <div class="jumbotron ">
        <h1 class="display-4">HELLO YII</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div> -->

    <!-- <div class="body-content">

        <div class="row"> -->
            <div class="col-lg-8">
                <?php foreach ($berita as $tampil_berita): ?>
                        <!-- menampilkan judul berita -->
                    <h2><?= Html::encode($tampil_berita->judul) ?></h2>
                    <span>
                            <!-- menampilkan tanggal posting berita -->
                            <strong>Tanggal : </strong><time><?= Html::encode($tampil_berita->date) ?></time>
                            &nbsp;&nbsp;&nbsp;
                            <!-- menampilkan kategori berita -->
                            <strong>Kategori : </strong>
                            <?php  foreach($kategori as $kat) : 
                            if ($tampil_berita->id_category === $kat->id_category) {?>
                                <?= Html::encode($kat->name_category) ?>
                            <?php
                            }
                        endforeach;?>

                        &nbsp;&nbsp;&nbsp;
                        <!-- menampilkan pennulis berita -->
                        <strong>Penulis : </strong>
                        <?php foreach ($users as $penulis) : 
                        if ($tampil_berita->username === $penulis->username) {?>
                        <?= Html::encode($penulis->name) ?>
                            
                        <?php
                        }
                    endforeach;?>
                    <br>
                </span>
                <br>
                    <!-- menampilkan gambar berita -->
                    <img src="<?= Yii::$app->request->baseUrl.'/img_berita/'. $tampil_berita->id_berita. '.' . $tampil_berita->gambar?>" class="img-thumbnail">
                    <!-- menampilkan isi berita -->
                    <?php 
                    $isiberita = strip_tags($tampil_berita->isi_berita);
                    $isi = substr($isiberita,0,300);
                    ?>
                    <p><?= Html::encode($isi.'...') ?></p>
                    <p><a class="btn btn-outline-secondary" href="<?= Yii::$app->urlManager->createUrl(['site/view', 'id_berita' => $tampil_berita->id_berita])?>">Read More &raquo;</a></p>
                <?php endforeach;?>
        
                <?php foreach ($berita2 as $tampil_beritan) : ?>
                    <div class="col-lg-6">
                        <span>
                            <!-- menampilkan judul berita -->
                            <h2><?= Html::encode($tampil_beritan->judul) ?></h2>
                            <!-- menampilkan tanggal posting berita -->
                            <strong>Tanggal : </strong><time><?= Html::encode($tampil_beritan->date) ?></time>

                            <!-- menampilkan kategori berita -->
                            <strong>Kategori : </strong>
                            <?php  foreach($kategori as $kat) : 
                                if ($tampil_beritan->id_category === $kat->id_category) {?>
                                    <?= Html::encode($kat->name_category) ?>
                            <?php
                                } 
                        endforeach;?>
                            
                            <!-- menampilkan pennulis berita -->
                            <br>
                            <strong>Penulis : </strong>
                            <?php foreach ($users as $penulis) : 
                                if ($tampil_berita->username === $penulis->username) {?>
                                <?= Html::encode($penulis->name) ?>
                            <?php 
                                } 
                            endforeach;?>
                            <br>
                        </span>
                        <br>

                        <!-- menampilkan gambar berita -->
                        <img src="<?= Yii::$app->request->baseUrl.'/img_berita/'. $tampil_beritan->id_berita. '.' . $tampil_beritan->gambar?>" class="img-thumbnail">
                        <!-- menampilkan isi berita -->
                        <?php 
                            $isiberitan = strip_tags($tampil_beritan->isi_berita);
                            $isin = substr($isiberitan,0,200);
                        ?>
                        <p><?= Html::encode($isin.'...') ?></p>

                        <p><a class="btn btn-outline-secondary" href="<?= Yii::$app->urlManager->createUrl(['site/view', 'id_berita' => $tampil_beritan->id_berita])?>">Read More &raquo;</a></p>
                    </div>
                        <?php endforeach;?>
                    </div>

                    <?php require_once Yii::$app->basePath . '../views/site/kategori.php';?>

                    <!-- <div class="col-lg-3">
                        <h2>Heading</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem architecto recusandae ea expedita enim quibusdam amet unde vitae incidunt veniam.</p>
                        <p><a href="#" class="btn btn-outline-secondary">Test</a></p>
                    </div> -->
