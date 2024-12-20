<?php
session_start();

// Dostep do strony mozliwy jest tylko po przeslaniu formularza
if ( !(isset($_POST["post-id"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["content"])) ) {
    http_response_code(403); // Forbidden
    require "../errors/403.html";
    exit;
}


// Przetwarzanie danych formularza i przechowywanie ich w sesji
$postId = $_POST["post-id"];
$_SESSION["formData"][$postId] = $_POST;

// Funkcja konwersji BBCode na HTML
include_once ",../includes/bbcode-functions.php";
//function convertBBCodeToHTML(string $text): string {
//    $text = html_entity_decode($text);
//    /*
//    \[b] - znacznik [b]
//    \[\/b] - znacznik [/b]
//    . - dowolny znak wraz ze znakiem nowej linii (ze wzgledu na ustawiona flage s
//    * - zero lub wiecej poprzedzajacego elementu (czyli kropki)
//    ? - wyrazenie nongreedy - dopasowanie zatrzyma sie na pierwszym wystapieniu [/b]
//    (.*?) - cale wyrazenie dopasowuje dowolny tekst miedzy znacznikami, zachowujac ten tekst jako grupe do pozniejszego uzycia jako $1
//    */
//
//    $text = preg_replace("/\[b](.*?)\[\/b]/s", "<strong>$1</strong>", $text);
//    $text = preg_replace("/\[i](.*?)\[\/i]/s", "<em>$1</em>", $text);
//    $text = preg_replace("/\[u](.*?)\[\/u]/s", "<u>$1</u>", $text);
//    $text = preg_replace("/\[s](.*?)\[\/s]/s", "<s>$1</s>", $text);
//    $text = preg_replace("/\[ul](.*?)\[\/ul]/s", "<ul>$1</ul>", $text);
//    $text = preg_replace("/\[li](.*?)\[\/li]/s", "<li>$1</li>", $text);
//    $text = preg_replace("/\[quote](.*?)\[\/quote]/s", "<q>$1</q>", $text);
//    $text = preg_replace("/\[url=(.*?)](.*?)\[\/url]/s", '<a href="$1" target="_blank">$2</a>', $text);
//
//    return nl2br($text); // Zamiana nowych linii na <br>
//}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicons/favicon-16x16.png">
    <link rel="manifest" href="../images/favicons/site.webmanifest">

    <!-- Styles -->
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<?php require_once "../includes/header.php"; ?>

<main>
    <?php require_once "../includes/nav.php"; ?>

    <section id="main-section" class="add-comment-preview-section">
        <h1>Sprawdź swój komentarz przed dodaniem</h1>
        <p><b>Numer postu:</b> <?php echo htmlspecialchars($_POST["post-id"]); ?></p>
        <p><b>Nickname:</b> <?php echo htmlspecialchars($_POST["username"]); ?></p>
        <p><b>Email:</b> <?php echo htmlspecialchars($_POST["email"]); ?></p>
        <p><b>Komentarz:</b></p>
        <div class="comment-preview">
            <?php echo convertBBCodeToHTML($_POST["content"]); ?>
        </div>
<!--        --><?php //echo $_POST["url"];?>
<!--        <form action="--><?php //echo $_POST["url"];?><!--" method="post" style="display: inline;">-->
        <form action="../db/mysql-operation.php" method="post">
            <input type="hidden" name="url" value="<?php echo $_POST['url'] ?>" >
<!--            <input type="hidden" name="action" value="editForm">-->
<!--            <input type="hidden" name="action" value="">-->
            <button type="submit" name="action" class="form-button" value="editForm">Cofnij do poprawki</button>
<!--        </form>-->

<!--        <form action="../comments/test-submit.php" method="post" style="display: inline;">-->

<!--            <button type="submit" name="confirm" class="form-button" value="addComment">Zatwierdź</button>-->
            <button type="submit" name="action" class="form-button" value="addComment">Zatwierdź</button>
            <?php
            // Przesyłamy dane w ukrytych polach, aby były gotowe do zapisania w bazie
            foreach ($_POST as $key => $value) {
                if ($key != "content") {
                    echo "<input type='hidden' name='" . htmlspecialchars($key) . "' value='" . htmlspecialchars($value) . "'>";
                }
                else {
                    echo "<input type='hidden' name='" . htmlspecialchars($key) . "' value='" . convertBBCodeToHTML($value) . "'>";
                }

            }
            ?>
        </form>

    </section>

    <?php require_once "../includes/aside.php"; ?>

</main>

<?php require_once "../includes/footer.php"; ?>
</body>
</html>