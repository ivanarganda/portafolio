<?php ob_start(); ?>

<?php require_once "../../../middlewares/auth.php"; ?>

<?php require_once "../../../config/conection.php"; ?>

<?php require_once "utils/helpers.php"; ?>

<?php require_once "layouts/header.php"; ?>
    
<?php require_once "layouts/navbar.php"; ?>

<?php require_once "layouts/sidebar.php"; ?>

<?php require_once "utils/backdrop-loader.php"; ?>

<!-- Main Content -->
<main class="container-main main-content">
    <div class="container-fluid">
        <?php 
            if (isset($_GET['page']) && strpos($_GET['page'], 'login') === false) {
                $page = $_GET['page'];
                $sectionsTitle = [
                    'phone-listing' => 'Mi lista telefonica',
                    'order-listing' => 'Mis pedidos'
                ];
                $title_section = $sectionsTitle[$_GET['page']];
                if (!file_exists("$page.php")) {
                    require_once "utils/no-exist-section.php";
                } else {
                    require_once "$page.php";
                }
            } else {
                require_once "welcome.php";
            }
        ?>
    </div>
</main>

<?php require_once "layouts/footer.php"; ?>

<?php ob_end_flush(); ?>