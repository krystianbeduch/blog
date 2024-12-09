<?php
require_once ("modals.php");
?>

<script src="../js/user-account.js"></script>

<header>
    <h1>Blog programistyczny</h1>

        <?php if (isset($_SESSION["loginAlert"]) && $_SESSION["loginAlert"]["type"] == "danger"): ?>
            <div class="alert alert-danger fade show">
                <strong>Błąd!</strong> Nieprawidłowe hasło
            </div>

        <?php
            unset($_SESSION["loginAlert"]);
        endif ?>

        <?php if (isset($_SESSION["loginAlert"]) && $_SESSION["loginAlert"]["type"] == "success"): ?>
            <div class="alert alert-success">
                <strong>Zalogowano!</strong> Witaj <?php echo $_SESSION["loggedUser"]["username"] ?>
            </div>
        <?php
            unset($_SESSION["loginAlert"]);
        endif ?>

        <?php if (isset($_SESSION["logoutAlert"]) && $_SESSION["logoutAlert"]): ?>
            <div class="alert alert-success">
                Wylogowano pomyślnie
            </div>
            <?php
            unset($_SESSION["logoutAlert"]);
        endif ?>


        <?php if (!isset($_SESSION["loggedUser"])): ?>
        <!-- Przycisk logowania -->
        <a href="#" id="login-link">Zaloguj się</a>
        <?php endif ?>

        <!-- Sekcja dla zalogowanego uzytkownika -->
        <?php if (isset($_SESSION["loggedUser"])): ?>
        <div id="user-menu">
            <button id="profile-button">
                <span id="logged-user-username"><?php echo $_SESSION["loggedUser"]["username"] ?></span>
                <span class="arrow">▼</span>
            </button>
            <ul id="dropdown-menu">
                <li><a href="#">Edycja postów</a></li>
                <li><a href="#">Edycja profilu</a></li>
                <li><a href="../includes/logout.php">Wyloguj się</a></li>
            </ul>
        </div>
        <?php endif ?>
</header>