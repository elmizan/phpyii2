<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "berita".
 *
 * @property int $id_berita
 * @property int $id_category
 * @property string $username
 * @property string $judul
 * @property string $headline
 * @property string $isi_berita
 * @property string $date
 * @property string $gambar
 * @property int $dibaca
 */
class Berita extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'berita';
    }

    /**
     * {@inheritdoc}
     */
    // public $imageFile;

    public function rules()
    {
        return [
            [['id_category', 'judul', 'isi_berita', ], 'required'],
            [['id_category', 'dibaca'], 'integer'],
            [['headline', 'isi_berita'], 'string'],
            [['date'], 'safe'],
            [['username'], 'string', 'max' => 15],
            [['judul'], 'string', 'max' => 100],
            [['gambar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg ,jpeg', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_berita' => 'Id Berita',
            'id_category' => 'Id Category',
            'username' => 'Username',
            'judul' => 'Judul',
            'headline' => 'Headline',
            'isi_berita' => 'Isi Berita',
            'date' => 'Date',
            'gambar' => 'Gambar',
            'dibaca' => 'Dibaca',
        ];
    }

    // public function upload()
    // {
    //     if ($this->validate()) {
    //         $this->imageFile->saveAs('img_berita/'.$this->$model->id_berita.'.'.$this->imageFile->extension);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
