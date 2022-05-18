<div class="users-list">
    <table>
        <thead>
        <tr>
            <th>Nom utilisateur</th>
            <th></th>
        </tr>
        </thead>

        <tbody> <?php
        foreach($data['users_list'] as $user) { ?>
            <tr>
                <td><?= $user->getUsername() ?></td>
                <td>
                    <a class="button" href="/index.php?c=user&a=delete-user&id=<?= $user->getId() ?>">Supprimer</a>
                </td>
            </tr> <?php
        } ?>
        </tbody>
    </table>
</div>