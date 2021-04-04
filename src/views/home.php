<?php

use Model\NavLink;

$nav = $entityManager->getRepository("Model\NavLink")->findAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
</head>

<body>
    <nav>
        <ul>
            <?php
            foreach ($nav as $link) {
                print('<li><a href="?pageId=' . $link->getId() . '">' . $link->getLinkName() . '</a></li><br>');
            }
            ?>
        </ul>
    </nav>

    <?php

    if (!isset($_GET['pageId'])) {
        print($nav[0]->getLinkContent());
    } else {
    }

    ?>

</body>

</html>