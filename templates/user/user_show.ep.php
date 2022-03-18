
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $_["user"]["name"] ?> - PhpFromZero</title>
     
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
                    <h1 class="display-5 fw-bold">Profile de <?= $_["user"]["name"] ?></h1>
                    <p class="fs-4"><img src'<?= $_['user']['photo'] ?>'/> </p>
                </div>
            </div>
        </div>
    </header>
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
