<?php

use Model\NavLink;

require_once "./bootstrap.php";

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
                $IdRef = null;
                if ($link->getId() === 1) {
                    $IdRef = './';
                } else {
                    $IdRef = '?pageId=' . $link->getId();
                }
                print('<li><a href="' . $IdRef . '">' . $link->getLinkName() . '</a></li>');
            }
            ?>
        </ul>
    </nav>

    <?php

    if ($_SERVER['REQUEST_URI'] === ($rootDir . '/')) {
        $content = $entityManager->find('Model\NavLink', 1);
        print($content->getLinkContent());
    } else if (isset($_GET['pageId'])) {
        $content = $entityManager->find('Model\NavLink', $_GET['pageId']);
        print($content->getLinkName() . '<br>');
        print($content->getLinkContent());
    }
    ?>

</body>

</html>