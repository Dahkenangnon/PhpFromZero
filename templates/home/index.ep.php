<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="" />
    <meta name="description" content="" />
    <title>Accueil - PhpFromZero</title>

    <!-- CSS -->
    <?php
    include_once($ep_project_root . '/templates/partials/_asset.css.php');
    ?>
</head>

<body>

    <!-- Responsive navbar-->
    <?php
    include_once($ep_project_root . '/templates/partials/_nav.ep.php');
    ?>

    <!-- Header-->
    <header class="py-5">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                <div class="m-4 m-lg-5">
                    <h1 class="display-5 fw-bold">PhpFromZero</h1>
                    <br><br>
                    <?php
                    if (isAuthenticated()) {
                    ?>
                        <a class="btn btn-primary btn-lg" href="/message/new"><?= $ep_user["name"] ?>, Ajoutez un message </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>


    <!-- Page Content-->
    <section class="pt-4">
        <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">

                <?php
                foreach ($_['messages'] as $message) {
                ?>
                    <div class="col-lg-6 col-xxl-4 mb-5">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa fa-message"></i></div>
                                <h2 class="fs-4 fw-bold"><?= $message['title'] ?></h2>
                                <p class="mb-0"><?= $message['content'] ?></p>
                                <?php
                                if (isAdmin()) {
                                ?>
                                    <form action="<?= '/message/' . $message["id"] ?>" method="post"><button class="bg-danger" type="submit">Supprimer</button></form>
                                <?php
                                }
                                ?>
                                <br>
                                <button><a href="<?= '/message/show-' . $message["id"] ?>">Details</a></button>
                            </div>
                        </div>
                    </div>
                <?php
                }

                ?>
            </div>
        </div>
    </section>


    <!-- Footer-->
    <?php
    include_once($ep_project_root . '/templates/partials/_footer.ep.php');
    ?>


    <!-- Js Files-->
    <?php
    include_once($ep_project_root . '/templates/partials/_asset.js.php');
    ?>

</body>

</html>