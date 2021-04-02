<?php

use Model\NavLink;

require_once "bootstrap.php";

$newLinkName = $argv[1];

$newLink = new NavLink();
$newLink->setLinkName($newLinkName);
$entityManager->persist($newLink);
$entityManager->flush();

echo "Created Product with ID " . $newLink->getId() . "\n";
