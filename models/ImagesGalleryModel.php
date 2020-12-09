<?php

namespace alex290\widgetgallery\models;

use Yii;

/**
 * This is the model class for table "images_gallery_model".
 *
 * @property int $id
 * @property int $weight
 * @property string $modelName
 * @property int $itemId
 * @property string|null $title
 * @property string|null $desc
 */
class ImagesGalleryModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images_gallery_model';
    }

    public $imageFile;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'alex290\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weight', 'modelName', 'itemId'], 'required'],
            [['weight', 'itemId'], 'integer'],
            [['desc'], 'string'],
            [['modelName'], 'string', 'max' => 150],
            [['title'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'weight' => 'Weight',
            'modelName' => 'Model Name',
            'itemId' => 'Item ID',
            'title' => 'Title',
            'desc' => 'Desc',
            'imageFile'=> 'Images',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $patch = 'upload/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($patch);

            $this->attachImage($patch);

            unlink($patch);
            return true;
        } else {
            return false;
        }
    }
}
