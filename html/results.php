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
            <li><a href="rules.php">ZASADY</a></li>
            <li><a class="active" href="results.php">WYNIKI</a></li>
        </ul>
    </div>

<h3>
<?php
include_once('php_variables/config-db.php');
$dbconn = pg_connect($postgresqlConnectionString) or die('Could not connect: ' . pg_last_error());

$query = 'SELECT name, points FROM teams ORDER BY points DESC;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$resultArr = pg_fetch_all($result);

echo '<table>';

foreach($resultArr as $array)
{
    echo '<tr>
            <td>'. $array['name'].'</td>
            <td>'. $array['points'].'</td>
          </tr>';
}
echo '</table>';

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

</body>
</html>
