
<h1>Modifier un commentaire.</h1>
<?php
$products = $data['products'] ?? [];
?>
<form action="/index.php?c=comment&a=edit-comment&id=<?= $data['comment']['id']?>" method="post">
    <div>
        <label for="title">Choisissez l'article</label>
        <select name="comment-article" id="comment-article"><?php
            foreach($products as $product) { ?>
                <option value="<?= $product->getId() ?>"><?= $product->getName() ?></option> <?php
            } ?>
        </select>
    </div>
    <div>
        <textarea name="content" id="content" cols="30" rows="20"><?= $data['comment']['content'] ?></textarea>
    </div>

    <input type="submit" name="send-form" value="Enregistrer">
</form>
