<h1 class="add-product-title">Ajouter un Samsung.</h1>

<form action="/index.php?c=admin&a=add-product" method="post" class="add-product-form">
    <div>
        <label for="title">Nom du Samsung : </label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="date_release">Date de sortie : </label>
        <input type="date" name="date_release" id="date_release">
    </div>
    <div>
        <textarea name="content" id="content" cols="30" rows="20" placeholder="Contenu"></textarea>
    </div>

    <input type="submit" name="send-form" value="Enregistrer" class="add-product-button">
</form>
