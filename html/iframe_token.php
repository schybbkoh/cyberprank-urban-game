<html>

<head>
    <meta charset="utf-8">
    <title>Cyberprank 2069 — gra miejska</title>
    <link type="text/css" rel="stylesheet" href="/css/main.css">
</head>

<h3>

<?php
if(isset($_POST['submit_token']))
{
//echo 'token wyslany<br>';

$riddle_token = $_POST['token_given'];
$team_id = $_POST['team_id_given'];
$riddle_id = $_POST['riddle_id_given'];

//echo "riddle_token=" . $riddle_token . "<br>";
//echo "team_id=" . $team_id . "<br>";
//echo "riddle_id=" . $riddle_id . "<br>";

// Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=cyberprank2069db user=cyberprank2069user password=cyberprank2069password")
    or die('Could not connect: ' . pg_last_error());

// Performing SQL query
//$query = 'SELECT solution, coordinate_x, coordinate_y FROM riddles where id = 4';
//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
//$row = pg_fetch_row($result);
//

$query = 'SELECT token FROM riddles where id = $1';
$result = pg_query_params($dbconn, $query, array($riddle_id)) or die('Query failed: ' . pg_last_error());
//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$row = pg_fetch_row($result);

//echo $row[0];

//echo "row0=" . $row[0] . "<br>";

       if ($row[0] == $riddle_token)
        {
	//echo "Podałeś poprawny token dla tej zagadki.";

//$query5 = 'SELECT finish_hour FROM timetable LIMIT 1';
$query5 = 'SELECT extract(epoch from finish_hour) FROM timetable LIMIT 1;';
$result5 = pg_query($query5) or die('Query failed: ' . pg_last_error());
$row5 = pg_fetch_row($result5);

if (time() > $row5[0])
{
//echo "Token jest poprawny, ale czas gry minął. Odpowiedzi nie są już przyjmowane. Wróć do lokalu.";
echo "
<script>
var data = 'Token jest poprawny, ale czas gry minął. Odpowiedzi nie są już przyjmowane. Wróć do lokalu. Stronka zostanie przeładowana.';
var event = new CustomEvent('myCustomEvent2', { detail: data })
window.parent.document.dispatchEvent(event)
</script>
";
}
else
{
//$query7 = 'SELECT solved_riddles_by_id FROM teams WHERE id = $1';
$query7 = 'select * from teams where id = $1 and $2=ANY(solved_riddles_by_id)';
$result7 = pg_query_params($dbconn, $query7, array($team_id, $riddle_id)) or die('Query failed: ' . pg_last_error());
//$row7 = pg_fetch_row($result7);
//$status7 = pg_result_status($result7);
$rows7 = pg_num_rows($result7);

if ($rows7 != 0)
{
echo "
<script>
var data = 'Podany zespół już rozwiązał tę zagadkę. Punkty NIE zostaną naliczone. Stronka zostanie przeładowana.';
var event = new CustomEvent('myCustomEvent2', { detail: data })
window.parent.document.dispatchEvent(event)
</script>
";
}
else
{
//$query2 = 'SELECT token FROM riddles where id = $1';
$query2 = "INSERT INTO history VALUES (DEFAULT, DEFAULT, $1, $2)";
$result2 = pg_query_params($dbconn, $query2, array($team_id, $riddle_id)) or die('Query failed: ' . pg_last_error());
//$result = pg_query($query) or die('Query failed: ' . pg_last_error());
//$row = pg_fetch_row($result);

$query3 = "UPDATE teams SET points = points + 1 WHERE id = $1";
$result3 = pg_query_params($dbconn, $query3, array($team_id)) or die('Query failed: ' . pg_last_error());

$query4 = "UPDATE riddles SET solve_count = solve_count + 1 WHERE id = $1";
$result4 = pg_query_params($dbconn, $query4, array($riddle_id)) or die('Query failed: ' . pg_last_error());

$query6 = "UPDATE teams SET solved_riddles_by_id = array_append(solved_riddles_by_id, $1) WHERE id = $2;";
$result6 = pg_query_params($dbconn, $query6, array($riddle_id, $team_id)) or die('Query failed: ' . pg_last_error());

$query5 = 'SELECT finish_hour FROM timetable WHERE id = 1';
$result5 = pg_query($query5) or die('Query failed: ' . pg_last_error());
$row5 = pg_fetch_row($result5);

//echo "Podałeś poprawny token dla tej zagadki. Baza zaktualizowana.";
echo "
<script>
var data = 'Odpowiedź poprawna. Punkty zostały naliczone. Stronka zostanie przeładowana.';
var event = new CustomEvent('myCustomEvent2', { detail: data })
window.parent.document.dispatchEvent(event)
</script>
";
}
}
	}
	else
	{
//	echo "Podałeś niepoprawny token dla tej zagadki.";
echo "
<script>
var data = 'Podałeś niepoprawny token dla tej zagadki.';
var event = new CustomEvent('myCustomEvent2', { detail: data })
window.parent.document.dispatchEvent(event)
</script>
";
	}

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);


}
?>

</h3>

</html>
