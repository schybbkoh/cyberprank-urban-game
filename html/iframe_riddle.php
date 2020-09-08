<html>

<head>
    <meta charset="utf-8">
    <title>Cyberprank 2069 — gra miejska</title>
    <link type="text/css" rel="stylesheet" href="/css/main.css">
</head>

<h3>
<?php

$riddle_solution = "";
$riddle_id = "";

// react on submitting riddle solution
if (isset($_POST['Submit']))
{
    $riddle_solution = $_POST['riddle_solution_given'];
    $riddle_id = $_POST['riddle_id_given'];

    include_once ('php_variables/config-db.php');
    $dbconn = pg_connect($postgresqlConnectionString) or die('Could not connect: ' . pg_last_error());

    // grab proper solution and corrdinates from database
    $query = 'SELECT solution, coordinate_x, coordinate_y FROM riddles where id = $1';
    $result = pg_query_params($dbconn, $query, array( $riddle_id )) or die('Query failed: ' . pg_last_error());
    $row = pg_fetch_row($result);

    // grab teams' list
    $query2 = 'SELECT id, name from teams ORDER BY id;';
    $result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());

    // if solution given is correct
    if ($row[0] == $riddle_solution)
    {
	// display proper content
        echo "Zagadka rozwiązana poprawnie!<br>";
        echo "Udaj się pod poniższe współrzędne i odnajdź wlepkę, a następnie wprowadź jej token, aby zdobyć punkt:<br>";
        echo "$row[1], $row[2] lub ", '<span id="navigation"></span>';
        echo '<script type="text/javascript" src="scripts/navigation.js"></script>';
        echo '<script type="text/javascript"> navigate(', "$row[1]", ',', "$row[2]", '); </script>';

	// and load list of teams to choose from
        echo '<div id=' . $row[0] . '>
	<form action="iframe_token.php" target=' . $row[0] . ' method="post">
	<input type="hidden" name="riddle_id_given" value=' . $riddle_id . '>
	<label for="text">Token:</label>
	<input type="text" name="token_given" placeholder="Podaj token z wlepki" required>
	<label for="text">Twój zespół:</label>
	<select name="team_id_given" id="teams" required>
	<option value="">--- wybierz z listy ---</option>';

        while ($row2 = pg_fetch_row($result2))
        {
            echo '<option value=' . $row2[0] . '>' . $row2[1] . '</option>';
        }

        echo '</select>
	<input type="submit" name="submit_token" value="WYŚLIJ">
	</form>
	</div>
	<iframe name=' . $row[0] . ' id="iframe" src="iframe_token.php" style="width:0;height:0;border:0; border:none;"></iframe>';
    }
    // if solution given is not correct
    else
    {
        echo "Rozwiązanie niepoprawne. Próbuj dalej.";
    }

    pg_free_result($result);
    pg_free_result($result2);
    pg_close($dbconn);
}

?>
</h3>

// handle communication between bottom iframe and top window
// this iframe is in between so it needs to relay messages
<script>
window.document.addEventListener('myCustomEvent2', handleEvent, false)

function handleEvent(e2) {
    var event = new CustomEvent('myCustomEvent', {
	detail: e2.detail.toString()
    })
    window.parent.document.dispatchEvent(event)
}
</script>

</html>
