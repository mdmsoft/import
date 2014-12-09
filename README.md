Import Namespace
========================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require mdmsoft/import "~1.0"
```

for dev-master

```
php composer.phar require mdmsoft/import "~1.0"
```

or add

```
"mdmsoft/import": "~1.0"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, use in your code:

```php
<?php
Import::using('yii\bootstrap\Button'); // import yii\bootstrap\Button
Import::using('yii\widgets\*'); // import all class under namespace yii\widgets
?>
<?php
echo Button::widget([
    'label' => 'Action Test',
    'options' => ['class' => 'btn-lg'],
]);
?>

<?php Spaceless::begin(); ?>
<div>
    <span>ABCDE</span>
</div>
<?php Spaceless::end();?>

<?php $form = ActiveForm::begin()?>
    <?= $form->field($model,'attribute'); ?>

<?php ActiveForm::end();?>
```
