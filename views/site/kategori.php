<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Berita;
use app\models\Kategori;
?>

<div class="col-lg-4">
    <h3>Kategori Berita</h3>
    <?php foreach ($kategori as $linkkat) : ?>
        <p><strong>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/viewkategori', 'id_category'=> $linkkat->id_category])?>">
                <?= Html::encode($linkkat->name_category) ?>
            </a>
        </strong></p>
    <?php endforeach;?>
</div>