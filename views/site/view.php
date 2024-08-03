<?php

/** @var yii\web\View $this */
use yii\widgets\ActiveForm;

$this->title = 'CRUD using Yii';
?>

<div class="container" >
    <h1 class="mt-5 text-success">View Product</h1>
<div class="card mt-5" >
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Title : <?php echo $product->title ?></li>
    <li class="list-group-item">Description : <?php echo $product->description ?></li>
    <li class="list-group-item">Price : <?php echo $product->price ?></li>
  </ul>
</div>
<div class="mt-4">
    <a href=<?php echo Yii::$app->homeUrl;?> class="btn btn-success" >Go back</a>
</div>
</div>