<aside>
    <!-- Panel administracyjny -->
    <?php if (isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"]["role"] == "Admin"): ?>
    <section>
        <h3><a href="../pages/admin-panel.php">Panel administracyjny</a></h3>
    </section>
    <?php endif; ?>

    <!-- O autorze -->
    <?php if (isset($post) && !empty($post["about_me"])): ?>
    <section>
        <h3>O autorze</h3>

        <p><?php echo $post["about_me"] ?></p>
    </section>
    <?php endif ?>

    <!-- Kalendarz -->
    <section>
        <h3>Kalendarz</h3>
        <p>Wydarzenia w nadchodzącym miesiącu:</p>
        <ul>
            <li>15.10.2024 - Web Dev Conference</li>
            <li>22.10.2024 - Warsztaty z Javy</li>
            <li>30.10.2024 - Hackathon Pythonowy</li>
        </ul>
    </section>

    <!-- Archiwum -->
    <section>
        <h3>Archiwum</h3>
        <ul>
            <li><a href="#">Wrzesień 2024</a></li>
            <li><a href="#">Sierpień 2024</a></li>
            <li><a href="#">Lipiec 2024</a></li>
            <li><a href="#">Czerwiec 2024</a></li>
        </ul>
    </section>

    <!-- Linki do innych stron -->
    <section>
        <h3>Przydatne zasoby</h3>
        <ul>
            <li><a href="https://www.w3schools.com" target="_blank">W3Schools</a></li>
            <li><a href="https://javastart.pl" target="_blank">Java Start</a></li>
        </ul>       
    </section>



<!--    <section>-->
<!--        <h3><a href="../pages/blackjackOOP.php">Zagraj w BlackJacka</a></h3>-->
<!--    </section>-->
<!---->
<!--    <section>-->
<!--        <h3><a href="../pages/snake.php">Zagraj w Snake'a</a></h3>-->
<!--    </section>-->
<!---->
<!--    <section>-->
<!--        <h3><a href="../pages/whack-a-mole.php">Zagraj w Whack A Mole</a></h3>-->
<!--    </section>-->
<!---->
<!--    <section>-->
<!--        <h3><a href="../pages/drag-racers.php">Zagraj w Drag Racers</a></h3>-->
<!--    </section>-->

    <section>
        <h3><a href="../pages/games.php">Zagraj w gry</a></h3>
    </section>
</aside>