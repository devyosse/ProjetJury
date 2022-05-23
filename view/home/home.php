<h1 class="homee">Accueil</h1>

<h2 class="home-title">Bienvenue connecte-toi</h2>

<p class="home-content">
    Tu es ici car tu te veux te renseigner sur les dernières actualités Samsung ? <br>
    Tu es bien tombés, mon site te documentera sur toutes les gammes Samsung.<br>
    Ainsi tu pourra choisir le smartphone qui te correspond le mieux.
</p>

<p class="home-content">
    <a class="comment-link" href="/index.php?c=comment&a=add-comment">Ajouter un commentaire</a>
</p>

<div class="container"> <?php

    use App\Controller\AbstractController;

    foreach ($data['products'] as $product) { ?>
        <div class="phone-detail">
            <h2><?= $product->getName() ?></h2>
            <small>Date de sortie: <?=
                DateTime::createFromFormat('Y-m-d H:i:s', $product->getDateRelease())->format('d-m-Y'); ?>
            </small>
            <p><?= $product->getContent() ?></p>
        </div> <?php
    }

    $comments = $data['comments'] ?? [];
    ?>
    <h2 class="comment-title">Commentaires</h2>
    <div class="comments"> <?php
        foreach ($comments as $comment) { ?>
            <div class="comment">
                <h3><?= $comment->getProduct()->getName() ?></h3>
                <p><?= $comment->getContent() ?></p>
                <small><?= $comment->getAuthor()->getUsername() ?></small> <?php
                if( AbstractController::isUserConnected() &&
                    ($comment->getAuthor()->getId() === $_SESSION['user']->getId() ||
                    AbstractController::isUserAdmin())
                ) { ?>
                    <a href="/index.php?c=comment&a=edit-comment&id=<?= $comment->getId() ?>" class="edit-comm-button">
                        Editer
                    </a>
                    <a href="/index.php?c=comment&a=delete-comment&id=<?= $comment->getId() ?>" class="delete-comm-button">
                        Supprimer
                    </a > <?php
                }
                ?>
            </div>
            <hr><?php
        } ?>
    </div>
</div>
