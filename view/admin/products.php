<div class="products-list"> <?php
    foreach($data['products'] as $product) { ?>
        <div class="product">
            <h2 class="product-title"><?= $product->getName() ?></h2>
            <small class="product-release-date"><?=
                DateTime::createFromFormat('Y-m-d H:i:s', $product->getDateRelease())->format('d-m-Y'); ?>
            </small>
            <p class="product-content"><?= $product->getContent() ?></p>
            <div>
                <a href="/index.php?c=admin&a=edit-product&id=<?= $product->getId() ?>" class="button">Modifier</a>
                <a href="/index.php?c=admin&a=delete-product&id=<?= $product->getId() ?>" class="button">Supprimer</a>
            </div>
        </div> <?php
    } ?>
</div>

