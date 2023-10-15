<?php
function is_active($path) {
    $currentPath = $_SERVER['REQUEST_URI'];
    if ($path === $currentPath) {

        echo 'active';
    } else {
        echo '';
    }
}
?>