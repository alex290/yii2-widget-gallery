<?php

use alex290\widgetgallery\assets\GallWidgetAsset;
use alex290\widgetgallery\models\ImagesGalleryModel;
use alex290\widgetgallery\models\NewImages;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

GallWidgetAsset::register(Yii::$app->view);
$models = null;
$newImages = new NewImages();

if ($itemId > 0) {
    $models = ImagesGalleryModel::find()->andWhere(['modelName' => $modelName])->andWhere(['itemId' => $itemId])->orderBy(['weight' => SORT_ASC])->all();
    $data = Json::encode([
        'patch' => $subdir,
        'model' => $modelName,
        'id' => $itemId,
        'url' => $url,
    ]);
}


?>

<?php if ($itemId > 0) : ?>
    <?php if ($models != null) : ?>
        <div class="sortableWidgetContent">
            <?php foreach ($models as $key => $gall) : ?>
                <div class="card" data-id=<?= $gall->id ?>>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
<?php endif ?>
<?php $form = ActiveForm::begin() ?>

<?= $form->field($newImages, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>