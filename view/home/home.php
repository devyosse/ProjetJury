<h1 class="homee">Accueil</h1>

<h2 class="home-title">Bienvenue connecte-toi pour avoir accès au site dans son intégralité</h2>

<p class="home-content">
    Tu es ici car tu te veux te renseigner sur les dernières actualités Samsung ? <br>
    Tu es bien tombés, mon site te documentera sur toutes les gammes Samsung.<br>
    Ainsi tu pourra choisir le smartphone qui te correspond le mieux.
</p>

<div class="container"> <?php
    foreach ($data['products'] as $product) { ?>
        <div class="phone-detail">
            <h2><?= $product->getName() ?></h2>
            <small>Date de sortie: <?= $product->getDateRelease() ?></small>
            <p><?= $product->getContent() ?></p>
        </div> <?php
    }
    ?>
</div>
