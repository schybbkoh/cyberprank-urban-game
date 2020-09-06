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
--- wszystkie wlepki rozmieszczono w promieniu $PROMIEŃ_GRY od miejsca zbiórki<br>
--- wszystkie wlepki rozmieszczono w publicznie dostępnych miejscach na wysokości nie wyższej niż 2m<br>
- należy dotrzeć do wlepki, odnaleźć ją i odczytać znajdujący się na niej token<br>
- token następnie należy wprowadzić w formularzu pod wybraną zagadką aby zdobyć punkt<br>
- jeden token może zostać wykorzystany tylko przez dwie grupy, później zagadka wygasa (będzie to odpowiednio oznaczone)<br>
- po wygaśnięciu czasu gry (2 godziny, patrz: licznik na górze strony) punkty nie będą już przyznawane<br>
- po zakończeniu zabawy spotykamy się w Hexie<br>

<br>Przykładowa wlepka wygląda jak niżej:<br>
$FOTO_TOKENU
</h3>

<?php
include_once('php_variables/config-db.php');
$dbconn = pg_connect($postgresqlConnectionString) or die('Could not connect: ' . pg_last_error());

$dbconn_time_query = 'SELECT extract(epoch from finish_hour) FROM timetable LIMIT 1;';
$dbconn_time_query_result = pg_query($dbconn_time_query) or die('Query failed: ' . pg_last_error());
$game_finish_time = pg_fetch_row($dbconn_time_query_result);

pg_free_result($dbconn_time_query_result);
pg_close($dbconn);
?>

<script>
//var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
var countDownDate = new Date(<?php echo $game_finish_time[0]?>*1000)

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("timer").innerHTML = "pozostało: " + hours + ":" + minutes + ":" + seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "KONIEC CZASU GRY";
  }
}, 1000);
</script>

<script>
function openForm(id) {
  document.getElementById(id).style.display = "block";
}

function closeForm(id) {
  document.getElementById(id).style.display = "none";
}

    var iframe = document.getElementById("iframe");
    iframe.onload = function(){
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
    }

</script>


</body>
</html>
