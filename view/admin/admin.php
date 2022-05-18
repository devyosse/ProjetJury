
<h1>Bienvenue a toi Administrateur !</h1>

<h2>Liste Utilisateurs</h2>

<p>Stats Utlisateurs<a href="/index.php?c=user&a=show">Ici</a></p>

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
