<?php
/* @var $this FilesController */
/* @var $model Files */

$this->breadcrumbs=array(
	'Files'=>array('admin'),
	'Upload',
);

$this->menu=array(
	array('label'=>'List Files', 'url'=>array('admin')),
);
?>

<h1>Upload File</h1>

<?php
	if (Yii::app()->user->hasFlash('success')) {
?>
<h4 style="color: green; font-weight: bold;"><?= Yii::app()->user->getFlash('success'); ?></h4>
<?php
	}
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>