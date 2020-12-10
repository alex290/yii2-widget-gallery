<?php

use alex290\widgetgallery\assets\GallWidgetAsset;
use alex290\widgetgallery\models\ImagesGalleryModel;
use alex290\widgetgallery\models\NewImages;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

GallWidgetAsset::register(Yii::$app->view);
$models = null;
$newImages = new NewImages();


$jsFile = <<<JS
$('.add-image-fileinput-gall').each(function(index, element) {
    $(this).fileinput({
        theme: 'fas',
        language: 'ru',
        allowedFileExtensions: ['jpg', 'png', 'jpeg', 'svg'],
        initialPreviewAsData: true,
        showUpload: false,
        showRemove: false,
        // maxFileSize: 2000,
    });
});
JS;

Yii::$app->view->registerJs($jsFile);

if ($itemId > 0) {
    $models = ImagesGalleryModel::find()->andWhere(['modelName' => $modelName])->andWhere(['itemId' => $itemId])->indexBy('id')->orderBy(['weight' => SORT_ASC])->all();
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
        <div class="sortableWidgetGallery row">
            <?php foreach ($models as $index => $gall) : ?>
                <div class="col-12 col-md-4 sortableWidgetGalleryItem mb-4" data-id=<?= $gall->id ?>>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <i class="fas fa-bars" style="cursor: pointer;"></i>
                            <?= Html::a('<i class="far fa-trash-alt"></i>', ['/widget-gallery/image/delete', 'id' => $gall->id, 'url' => $url], ["class" => "btn btn-outline-dark btn-sm"]) ?>
                        </div>
                        <div class="card-body">
                            <?php if ($title != false) : ?>
                                <div class="form-group field-imagesgallerymodel-<?= $index ?>-title">
                                    <label class="control-label" for="imagesgallerymodel-<?= $index ?>-title"><?= $title ?></label>
                                    <?= Html::textInput("ImagesGalleryModel[{$index}][title]", $gall->title, ["id" => "imagesgallerymodel-" . $index . "-title", "class" => "form-control"]) ?>
                                    <div class="help-block"></div>
                                </div>
                            <?php endif; ?>
                            <img src="/web/<?= $gall->getImage()->getPath('550x') ?>" width="100%" alt="">
                            <?php if ($desc != false) : ?>
                                <div class="form-group field-imagesgallerymodel-<?= $index ?>-desc">
                                    <label class="control-label" for="imagesgallerymodel-<?= $index ?>-desc"><?= $desc ?></label>
                                    <?= Html::textarea("ImagesGalleryModel[{$index}][desc]", $gall->desc, ["id" => "imagesgallerymodel-" . $index . "-desc", "class" => "form-control"]) ?>
                                    <div class="help-block"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
<?php endif ?>

<?= Html::fileInput("NewImages[imageFiles][]", null, ['multiple' => true, 'class' => 'add-image-fileinput-gall', 'accept' => 'image/*']) ?>