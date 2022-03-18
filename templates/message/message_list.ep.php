<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Liste des 10 derniers message - PhpFromZero</title>
   
    <!-- CSS -->
     <?php
    include_once($ep_project_root . '/templates/partials/_asset.css.php');
    ?>

    <!-- Custom css for this page -->
    <style>
        ul, ol {list-style: none;}
    </style>
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
                    <h1 class="display-5 fw-bold">Liste des 10 derniers message</h1>
                    <ol>
                <?php
                foreach ($_["messages"] as $message) {
                ?>
                    <li>
                        <ul>
                            <li>Titre: <?= $message["title"] ?></li> &nbsp;
                            <li>Contenu: <?= $message["content"] ?></li> &nbsp;
                            <form action="<?= '/message/delete-'.$message["id"] ?>" method="post"><button  class="bg-danger" type="submit">Supprimer</button></form>
                            <a href="<?= '/message/show-'.$message["id"] ?>">Details</a>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ol>
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