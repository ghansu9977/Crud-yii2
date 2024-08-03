<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
/** @var app\models\Product[] $products */

$this->title = 'CRUD using Yii';
?>

<div class="container">
    <h1 class="text-center text-success my-4">Product Catalog Management</h1>
    <div class="d-flex justify-content-start mb-3">
        <?= Html::a('Add Product', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">S.NO</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($products) > 0): ?>
                            <?php foreach ($products as $index => $product): ?>
                                <tr>
                                    <th scope="row"><?= $index + 1 ?></th>
                                    <td><?= Html::encode($product->title) ?></td>
                                    <td><?= Html::encode($product->description) ?></td>
                                    <td><?= Html::encode($product->price) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <?= Html::a('Edit', ['update', 'id' => $product->id], ['class' => 'btn btn-success']) ?>
                                            <?= Html::a('View', ['view', 'id' => $product->id], ['class' => 'btn btn-info']) ?>
                                            <?= Html::a('Delete', 'javascript:void(0);', [
                                                'class' => 'btn btn-danger',
                                                'onclick' => "
                                                    Swal.fire({
                                                        title: 'Are you sure?',
                                                        text: 'You won\'t be able to revert this!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Yes, delete it!'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            window.location.href = '" . \yii\helpers\Url::to(['delete', 'id' => $product->id]) . "';
                                                        }
                                                    });
                                                "
                                            ]) ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-muted">No records found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCssFile('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
