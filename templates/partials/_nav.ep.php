<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="/">PhpFromZero</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">A propos</a></li>
                <li class="nav-item"><a class="nav-link" href="/message">Message</a></li>
                <?php
                if (!isAuthenticated()) {
                ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Se connecter</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">S'incrire</a></li>
                <?php
                } else {
                ?>
                    <li class="nav-item"><a class="nav-link" href="/user/me">Compte <?= $ep_user["name"] ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Déconnection</a></li>
                    <li class="nav-item"><a class="nav-link" href="/message/new">Nouveau Message</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>