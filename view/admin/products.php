<h1>Ajouter un Samsung.</h1>

<form action="/index.php?c=&a=" method="post">
    <div>
        <label for="title">Nom du Samsung</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <textarea name="content" id="content" cols="30" rows="20" placeholder="Informations téléphone et performances"></textarea>
        // TO DO ajouter un input de fichier (img)
    </div>

    <input type="submit" name="save" value="Enregistrer">
</form>
