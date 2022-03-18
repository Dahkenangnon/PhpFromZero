<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Liste des copains - PhpFromZero</title>
      
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
                    <h1 class="display-5 fw-bold">Liste des copains</h1>
                    <p class="fs-4"><ol>
                <?php
                foreach ($_["users"] as $user) {
                ?>
                    <li>
                        <ul>
                            <li>id: <?= $user["id"] ?></li> &nbsp;
                            <li>Nom: <?= $user["name"] ?></li> &nbsp;
                            <li>Email: <?= $user["email"] ?></li> &nbsp;
                            <li>Age: <?= $user["age"] ?> ans</li> &nbsp;
                            <form action="<?= '/user/delete-'.$user["id"] ?>" method="post"><button type="submit">Supprimer</button></form>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ol></p>
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
