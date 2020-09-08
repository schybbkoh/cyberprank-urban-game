--
-- create riddles
--

DROP TABLE IF EXISTS riddles;

CREATE TABLE riddles (
	id serial PRIMARY KEY,
	riddle VARCHAR ( 400 ) NOT NULL,
	solution VARCHAR ( 50 ) NOT NULL,
	solve_count INTEGER NOT NULL,
	max_solve_count INTEGER NOT NULL,
	coordinate_x VARCHAR ( 20 ) NOT NULL,
	coordinate_y VARCHAR ( 20 ) NOT NULL,
	token VARCHAR ( 16 ) UNIQUE NOT NULL
);

ALTER TABLE riddles OWNER TO cyberprank2069user;

INSERT INTO riddles VALUES (DEFAULT, 'Dokąd nocą tupta jeż?', 'rozwiazanie1', 0, 3, '50.057965', '19.953745', 'token1');

INSERT INTO riddles VALUES (DEFAULT, 'Komu szumią wierzby?', 'rozwiazanie2', 0, 3, '50.057965', '19.953745', 'token2');

INSERT INTO riddles VALUES (DEFAULT, 'Gdzie podziały się pieniądze z OFE?', 'rozwiazanie3', 0, 3, '50.057965', '19.953745', 'token3');

INSERT INTO riddles VALUES (DEFAULT, 'Dlaczego rudzi są fałszywi?', 'rozwiazanie4', 0, 3, '50.057965', '19.953745', 'token4');

INSERT INTO riddles VALUES (DEFAULT, 'Kto wrobił Królika Rogera?', 'rozwiazanie5', 0, 3, '50.057965', '19.953745', 'token5');

INSERT INTO riddles VALUES (DEFAULT, 'Kebab?', 'rozwiazanie6', 0, 3, '50.057965', '19.953745', 'token6');

--
-- create teams
--

DROP TABLE IF EXISTS teams;

CREATE TABLE teams (
	id serial PRIMARY KEY,
	name VARCHAR ( 200 ) UNIQUE NOT NULL,
	points INTEGER NOT NULL,
	solved_riddles_by_id INTEGER[]
);

ALTER TABLE teams OWNER TO cyberprank2069user;

INSERT INTO teams VALUES (DEFAULT, 'Tyger Claws', '0');

INSERT INTO teams VALUES (DEFAULT, 'Animals', '0');

INSERT INTO teams VALUES (DEFAULT, 'Valentinos', '0');

INSERT INTO teams VALUES (DEFAULT, 'Mox', '0');

INSERT INTO teams VALUES (DEFAULT, 'Voodoo Boys', '0');

INSERT INTO teams VALUES (DEFAULT, '6th Street', '0');

INSERT INTO teams VALUES (DEFAULT, 'Maelstrom', '0');

--
-- create history
--

DROP TABLE IF EXISTS history;

CREATE TABLE history (
	id serial PRIMARY KEY,
	timestamp timestamptz DEFAULT NOW(),
	team_id INTEGER NOT NULL,
	riddle_id INTEGER NOT NULL
);

ALTER TABLE history OWNER TO cyberprank2069user;

--
-- create timetable
--

DROP TABLE IF EXISTS timetable;

CREATE TABLE timetable (
	id serial PRIMARY KEY,
	finish_hour timestamptz
);

ALTER TABLE timetable OWNER TO cyberprank2069user;


--
-- use this to configure timer
-- TRUNCATE TABLE timetable;
-- INSERT INTO timetable VALUES (DEFAULT, NOW() + INTERVAL '2 hours');
-- 
