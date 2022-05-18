<div class="products-list"> <?php
    foreach($data['products'] as $product) { ?>
        <div class="product">
            <h2 class="product-title"><?= $product->getName() ?></h2>
            <small class="product-release-date"><?= $product->getDateRelease() ?></small>
            <p class="product-content"><?= $product->getContent() ?></p>
            <div>
                <a href="/index.php?c=admin&a=editProduct&id=<?= $product->getId() ?>" class="button">Modifier</a>
                <a href="/index.php?c=admin&a=deleteProduct&id=<?= $product->getId() ?>" class="button">Supprimer</a>
            </div>
        </div> <?php
    } ?>
</div>

