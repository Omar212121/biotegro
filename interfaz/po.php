          <?php
session_start();
if (isset($_SESSION['usuario'])) {
    ?>

 <?php require_once "menu.php"; ?>

<h1>hola</h1>

                
                 <?php
} else {
}
?>
                