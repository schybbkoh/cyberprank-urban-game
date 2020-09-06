<!DOCTYPE html>
<html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <title>Cyberprank 2069 — gra miejska</title>
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <h1>CYBERPRANK 2069</h1>
    <h2>welcome to the Krak City!</h2>
    <p id="timer"></p>
    <div class="menu">
        <ul>
            <li><a href="index.php">ZAGADKI</a></li>
            <li><a class="active" href="rules.php">ZASADY</a></li>
            <li><a href="results.php">WYNIKI</a></li>
        </ul>
    </div>
    <h3>
Zasady są następujące: <br>
- na stronce opublikowano listę tematycznych zagadek<br>
- zagadki są wspólne dla wszystkich, można rozwiązywać je w dowolnej kolejności<br>
- w celu rozwiązania zagadki należy użyć guzika i podać rozwiązanie<br>
- rozwiązania to słowa składające tylko z litery (i ew. cyfr), ale bez polskich znaków diakrytycznych (ą, ę...), spacji i innych znaków specjalnych (?, $...)<br>
- przykładowe rozwiązanie "Mały Kebab?" powinno być wpisane jako "malykebab"<br>
- po rozwiązaniu zagadki otrzymacie koordynaty do odpowiedniej wlepki<br>
--- wszystkie wlepki rozmieszczono w promieniu do 1500m od Hexa<br>
--- wszystkie wlepki rozmieszczono w publicznie dostępnych miejscach na wysokości nie wyższej niż 2m<br>
- należy dotrzeć do koordynatów wlepki, odnaleźć ją i odczytać znajdujący się na niej token<br>
- token następnie należy wprowadzić w formularzu pod wybraną zagadką aby zdobyć punkt<br>
- jeden token może zostać wykorzystany tylko przez dwie grupy, później zagadka wygasa (będzie to odpowiednio oznaczone)<br>
- po wygaśnięciu czasu gry (2 godziny, patrz: licznik na górze strony) punkty nie będą już przyznawane<br>
- po zakończeniu zabawy spotykamy się w Hexie<br>

<br>Przykładowa wlepka wygląda jak niżej:<br><br>
<img src="images/token.JPG" alt="Przykładowy token" style="width:25%;">
</h3>

<?php
include_once('php_variables/config-db.php');
$dbconn = pg_connect($postgresqlConnectionString) or die('Could not connect: ' . pg_last_error());

$dbconn_time_query = 'SELECT extract(epoch from finish_hour) FROM timetable LIMIT 1;';
$dbconn_time_query_result = pg_query($dbconn_time_query) or die('Query failed: ' . pg_last_error());
$game_finish_time = pg_fetch_row($dbconn_time_query_result);

echo '<script type="text/javascript">var js_game_finish_time = ';
echo $game_finish_time[0];
echo ';</script>';
echo '<script type="text/javascript" src="scripts/timer.js">/<script>';

pg_free_result($dbconn_time_query_result);
pg_close($dbconn);
?>

<script type="text/javascript" src="scripts/common.js"></script>

</body>
</html>
