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
            <li><a class="active" href="index.php">ZAGADKI</a></li>
            <li><a href="rules.php">ZASADY</a></li>
            <li><a href="results.php">WYNIKI</a></li>
        </ul>
    </div>

<h3>
<?php

include_once('php_variables/config-db.php');
$dbconn = pg_connect($postgresqlConnectionString) or die('Could not connect: ' . pg_last_error());

$query = 'SELECT id, riddle, solve_count, max_solve_count FROM riddles ORDER BY id';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_row($result)) {
  echo "zagadka #$row[0] <br>";
  echo "rozwiązana przez: $row[2] (z max $row[3] zespołów) <br>";
  echo "treść zagadki: \"$row[1]\" <br>";

if ($row[2] < $row[3]) {
  echo "<button class=\"open-button\" onclick=\"openForm($row[0])\">KLIKNIJ, ABY ROZWIĄZAĆ ZAGADKĘ</button>";
} else {
  echo "LIMIT ROZWIĄZAŃ DLA ZAGADKI ZOSTAŁ WYCZERPANY";
}

echo '<div class="hidden_by_default" id='.$row[0].'>
<form action="iframe_riddle.php" target='.$row[0].' method="post">
  <label for="text">Rozwiązanie:</label>
  <input type="text" name="riddle_solution_given" placeholder="Podaj rozwiązanie" required>
  <input type="hidden" name="riddle_id_given" value='.$row[0].'>
  <input type="submit" name="Submit" value="WYŚLIJ">
  <button type="button" class="btn cancel" onclick="closeForm('.$row[0].')">ANULUJ</button>
</form>
<iframe name='.$row[0].' id="iframe" src="iframe_riddle.php" frameBorder="0"></iframe>
</div>';


  echo "<br> <br>";
}

$dbconn_time_query = 'SELECT extract(epoch from finish_hour) FROM timetable LIMIT 1;';
$dbconn_time_query_result = pg_query($dbconn_time_query) or die('Query failed: ' . pg_last_error());
$game_finish_time = pg_fetch_row($dbconn_time_query_result);

echo '<script type="text/javascript">var js_game_finish_time = ';
echo $game_finish_time[0];
echo ';</script>';
echo '<script type="text/javascript" src="scripts/timer.js"></script>';

pg_free_result($result);
pg_free_result($dbconn_time_query_result);

pg_close($dbconn);
?>
</h3>

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

<script>
window.document.addEventListener('myCustomEvent', handleEvent, false)
function handleEvent(e) {
alert( e.detail.toString() );

if ( e.detail.toString().includes("przeładowana")) {
  location.reload();
}
}
</script>

</body>

</html>
