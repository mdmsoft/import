Import Namespace
========================

Import classes under namespace and used without namespace.

[![Latest Stable Version](https://poser.pugx.org/mdmsoft/import/v/stable)](https://packagist.org/packages/mdmsoft/import)
[![Total Downloads](https://poser.pugx.org/mdmsoft/import/downloads.png)](https://packagist.org/packages/mdmsoft/import)
[![License](https://poser.pugx.org/mdmsoft/import/license)](https://packagist.org/packages/mdmsoft/import)
[![Dependency Status](https://www.versioneye.com/php/mdmsoft:import/dev-master/badge.png)](https://www.versioneye.com/php/mdmsoft:import/dev-master)
[![Code Climate](https://img.shields.io/codeclimate/github/mdmsoft/import.svg)](https://codeclimate.com/github/mdmsoft/import)

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
Import::using('yii\bootstrap\Html', 'BootstrapHtml'); // import with alias
Import::using([
    'yii\helpers\Html' => 'Html',
    'yii\helpers\ArrayHelper',
]);
?>
<?php
echo Button::widget([
    'label' => 'Action Test',
    'options' => ['class' => 'btn-lg'],
]);

echo BootstrapHtml::icon('star');
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
