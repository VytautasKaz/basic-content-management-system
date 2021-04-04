<?php
ob_start();
session_start();

require_once "./bootstrap.php";

$request = $_SERVER['REQUEST_URI'];

$root = '/cms';

switch ($request) {
    case $root . '/':
        require __DIR__ . '/src/views/home.php';
        break;
    case $root:
        require __DIR__ . '/src/views/home.php';
        break;
    case $root . '/admin':
        require __DIR__ . '/src/views/admin.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/src/views/err404.php';
        break;
}
