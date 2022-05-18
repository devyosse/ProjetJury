
<h1>Bienvenue a toi Administrateur !</h1>

<p>
    <a class="button" href="/index.php?c=user&a=show">Liste des utlisateurs</a>
    <a class="button" href="/index.php?c=user&a=show">Liste des produits</a>
</p>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom utilisateur</th>
        <th>Détails</th>
        <th>Supprimer</th>
    </tr>
    </thead>

    <tbody> <?php
    foreach($data['users_list'] as $user) { ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getUsername() ?></td>
            <td>
                <a href="/index.php?c=user&a=delete-user&id=<?= $user->getId() ?>">Supprimer</a>
            </td>
        </tr> <?php
    } ?>
    </tbody>
</table>
