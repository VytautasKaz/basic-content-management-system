<?php

use Model\NavLink;

require_once "./bootstrap.php";

$newLinkName = $argv[1];
$newLinkContent = $argv[2];

$newLink = new NavLink();
$newLink->setLinkName($newLinkName);
$newLink->setLinkContent($newLinkContent);
$entityManager->persist($newLink);
$entityManager->flush();

echo "Created Product with ID " . $newLink->getId() . "\n";
