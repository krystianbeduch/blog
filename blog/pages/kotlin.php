<?php
session_start();
require_once "../includes/pagination.php";
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$comments = [
    "Przykładowy komentarz 1",
    "Przykładowy komentarz 2",
    "Przykładowy komentarz 3"
];
$totalComments = count($comments);
$commentsPerPage = 5;

$paginationData = getPaginationData($currentPage, $totalComments, $commentsPerPage);
$currentPage = $paginationData["currentPage"];
$totalPages = $paginationData["totalPages"];
$offset = $paginationData["offset"];

$language = "kotlin";
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

    <!--  Styles -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-form.css">
    <link rel="stylesheet" href="../css/style-comments.css">

</head>
<body>
    <?php require_once "../includes/header.php"; ?>

    <main>
        <?php require_once "../includes/nav.php"; ?>

        <section id="main-section">
            <h1>Kotlin</h1>
            <p>
                Nowoczesny, wieloplatformowy język programowania, który jest w pełni interoperacyjny z Javą. Zyskał popularność przede wszystkim jako oficjalny język do tworzenia aplikacji na system Android, oferując nowoczesne podejście i większą zwięzłość kodu w porównaniu do Javy. Kotlin jest wykorzystywany zarówno w aplikacjach mobilnych, jak i na backendzie, gdzie współpracuje z popularnymi frameworkami jak Spring Boot, co czyni go wszechstronnym językiem do tworzenia skalowalnych aplikacji.
            </p>
            <img src="../images/kotlin_logo.png" alt="Kotlin logo">

            <article id="comments-section">
                <h3>Posty</h3>
                <div class="comment-container">

                    <?php renderPosts(array_slice($comments, $offset, $commentsPerPage, true));
                    // preserve_keys - zachowaj oryginalne klucze tablicy
                    ?>
                </div>
            </article>
            <?php include "../includes/form.php"; ?>

            <?php renderPagination($currentPage, $totalPages, $language); ?>
        </section>

        <?php require_once "../includes/aside.php"; ?>

    </main>

    <?php require_once "../includes/footer.php"; ?>
</body>

</html>