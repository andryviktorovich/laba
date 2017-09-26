<?php

use yii\helpers\Html;

/* @var $title boolean */
/* @var $message string */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelFormula->title, 'url' => ['view', 'id' => $modelFormula->id_formula]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="formula-error">

    <div class="alert alert-danger">
        <?= $message ?>
    </div>
</div>

