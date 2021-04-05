<?php
ob_start();

require_once "./bootstrap.php";

$request = $_SERVER['REQUEST_URI'];

$rootDir = '/cms';

switch ($request) {
    case $rootDir:
    case $rootDir . '/':
    case $rootDir . '/?pageId=' . $_GET['pageId']:
        require __DIR__ . '/src/views/home.php';
        break;
    case $rootDir . '/admin':
    case $rootDir . '/admin?action=logout':
        require __DIR__ . '/src/views/admin.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/src/views/err404.html';
        break;
}
