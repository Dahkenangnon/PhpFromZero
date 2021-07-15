<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>A propos - PhpFromZero Challenge</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= $ep_base_dir ?>/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= $ep_base_dir ?>/css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <?php
    include_once($ep_project_root . '/templates/partials/nav.ep.php');
    ?>
    <!-- Header-->
    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">Le PhpFromZero challenge</h1>
                    <p class="fs-4"> Deux amis du collège les "Hibiscus" de Parakou, tout nouveau étudiants développeur web
                        chez ePatriote se lancement un challenge.
                        Ils veulent savoir celui qui finira le plus tôt possible un site où ils pourront posté des message
                        de blague entre copain.

                        Le site doit être fait en PHP sans utiliser aucun framework et en orienté objet.
                        POur distinguer le meilleur développeur parmi les challengers, il sera tenu compte non seulement de la rapidité du codage mais aussi de l'organisation et du temps d'éxécution d'une même requête.</p>
                    <a class="btn btn-primary btn-lg" href="/message/new">Poster un message</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Footer-->
    <?php
    include_once($ep_project_root . '/templates/partials/footer.ep.php');
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= $ep_base_dir ?>js/scripts.js"></script>
</body>

</html>