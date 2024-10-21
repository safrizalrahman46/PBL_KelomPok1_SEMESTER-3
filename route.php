<?php
 
if (isset($_GET['pages'])) {
    $view = $_GET['pages'];
 
    switch ($view) {
        case 'home':
            include('./View/page/Home.php');
            break;
        case 'about':
            include('./View/page/About.php');
            break;
        case 'profile':
            include('./View/page/Profile.php');
            break;
        default:
            echo "Maaf... Halaman Tidak DI temukan";
            break;
    }
} else {
    include('./View/page/Home.php');
}

?>