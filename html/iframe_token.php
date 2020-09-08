<html>

<head>
    <meta charset="utf-8">
    <title>Cyberprank 2069 — gra miejska</title>
    <link type="text/css" rel="stylesheet" href="/css/main.css">
</head>

<h3>
<?php
if (isset($_POST['submit_token']))
{
    $riddle_token = $_POST['token_given'];
    $team_id = $_POST['team_id_given'];
    $riddle_id = $_POST['riddle_id_given'];

    include_once ('php_variables/config-db.php');
    $dbconn = pg_connect($postgresqlConnectionString) or die('Could not connect: ' . pg_last_error());

    $query = 'SELECT token, solve_count, max_solve_count FROM riddles where id = $1';
    $result = pg_query_params($dbconn, $query, array ( $riddle_id )) or die('Query failed: ' . pg_last_error());
    $row = pg_fetch_row($result);

    if ($row[1] >= $row[2])
    {
        echo "
            <script>
            var data = 'Wybraną zagadkę rozwiązano już maksymalną ilość razy. Stronka zostanie przeładowana.';
            var event = new CustomEvent('myCustomEvent2', { detail: data })
            window.parent.document.dispatchEvent(event)
            </script>
            ";
    }
    else
    {
        if ($row[0] == $riddle_token)
        {
            $query5 = 'SELECT extract(epoch from finish_hour) FROM timetable LIMIT 1;';
            $result5 = pg_query($query5) or die('Query failed: ' . pg_last_error());
            $row5 = pg_fetch_row($result5);

            if (time() > $row5[0])
            {
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
                $query7 = 'select * from teams where id = $1 and $2=ANY(solved_riddles_by_id)';
                $result7 = pg_query_params($dbconn, $query7, array( $team_id, $riddle_id )) or die('Query failed: ' . pg_last_error());
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

                    pg_free_result($result7);
                }
                else
                {
                    $query2 = "INSERT INTO history VALUES (DEFAULT, DEFAULT, $1, $2)";
                    $result2 = pg_query_params($dbconn, $query2, array( $team_id, $riddle_id )) or die('Query failed: ' . pg_last_error());

                    $query3 = "UPDATE teams SET points = points + 1 WHERE id = $1";
                    $result3 = pg_query_params($dbconn, $query3, array( $team_id )) or die('Query failed: ' . pg_last_error());

                    $query4 = "UPDATE riddles SET solve_count = solve_count + 1 WHERE id = $1";
                    $result4 = pg_query_params($dbconn, $query4, array( $riddle_id )) or die('Query failed: ' . pg_last_error());

                    $query6 = "UPDATE teams SET solved_riddles_by_id = array_append(solved_riddles_by_id, $1) WHERE id = $2;";
                    $result6 = pg_query_params($dbconn, $query6, array( $riddle_id, $team_id  )) or die('Query failed: ' . pg_last_error());

                    $query5 = 'SELECT finish_hour FROM timetable WHERE id = 1';
                    $result5 = pg_query($query5) or die('Query failed: ' . pg_last_error());
                    $row5 = pg_fetch_row($result5);

                    echo "
		    <script>
		    var data = 'Odpowiedź poprawna. Punkty zostały naliczone. Stronka zostanie przeładowana.';
		    var event = new CustomEvent('myCustomEvent2', { detail: data })
		    window.parent.document.dispatchEvent(event)
		    </script>
		    ";

                    pg_free_result($result2);
                    pg_free_result($result3);
                    pg_free_result($result4);
                    pg_free_result($result5);
                    pg_free_result($result6);
                }
            }
        }
        else
        {
            echo "
	    <script>
	    var data = 'Podałeś niepoprawny token dla tej zagadki.';
	    var event = new CustomEvent('myCustomEvent2', { detail: data })
	    window.parent.document.dispatchEvent(event)
	    </script>
	    ";
        }

        pg_free_result($result);
        pg_close($dbconn);
    }
}

?>
</h3>

</html>
