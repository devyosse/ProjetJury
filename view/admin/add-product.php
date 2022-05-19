<h1>Ajouter un Samsung.</h1>

<form action="/index.php?c=admin&a=add-product" method="post">
    <div>
        <label for="title">Nom du Samsung</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="date_release">Date de sortie</label>
        <input type="date" name="date_release" id="date_release">
    </div>
    <div>
        <textarea name="content" id="content" cols="30" rows="20"></textarea>
    </div>

    <input type="submit" name="send-form" value="Enregistrer">
</form>
