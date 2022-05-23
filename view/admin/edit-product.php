<h1 class="edit-product-title">Modifier un Samsung.</h1>

<?php
if(null === $data['product']) { ?>
    <div class="admin-error">Le produit n'existe pas, veuillez réessayer !</div><?php
}
else {
    $product = $data['product']; ?>
    <form action="/index.php?c=admin&a=edit-product&id=<?= $product->getId() ?>" method="post" class="edit-product-form">
        <div>
            <label for="title">Nom du Samsung</label>
            <input type="text" name="name" id="name" value="<?= $product->getName() ?>">
        </div>
        <div>
            <label for="date_release">Date de sortie</label>
            <input type="date" name="date_release" id="date_release" value="<?= $product->getDateRelease() ?>">
        </div>
        <div>
            <textarea name="content" id="content" cols="30" rows="20"><?= $product->getContent() ?></textarea>
        </div>

        <input type="submit" name="send-form" value="Enregistrer" class="edit-product-button">
    </form> <?php
}
