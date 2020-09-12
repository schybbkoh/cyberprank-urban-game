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

INSERT INTO riddles VALUES (DEFAULT, 'Jaki zespół nagrał pierwsze kilka oficjalnie opublikowanych utworów z gry?', 'refused', 0, 3, '50.051573', '19.937732', 'tfa18t1l');
INSERT INTO riddles VALUES (DEFAULT, 'Kto podkładał głos pod trailer Deep Dive? (imię)', 'borys', 0, 3, '50.057749', '19.934992', '235fhhzs');
INSERT INTO riddles VALUES (DEFAULT, 'Ile lat po swoim papierowym pierwowzorze dzieje się akcja CP2077?', '57', 0, 3, '50.064', '19.934', 'ef26qdmo');
INSERT INTO riddles VALUES (DEFAULT, 'Jaki napój promuje pani z siusiakiem?', 'chromanticure', 0, 3, '50.065546', '19.939378', 'mw0r68rf');
INSERT INTO riddles VALUES (DEFAULT, 'Jak nazywa się seria filmików promujących CP2077?', 'deepdive', 0, 3, '50.066499', '19.941861', 'cqkis9t6');

INSERT INTO riddles VALUES (DEFAULT, 'Jak na drugie imię ma Mike P.?', 'alyn', 0, 3, '50.060838', '19.9393028', '40bpmfrn');
INSERT INTO riddles VALUES (DEFAULT, 'W jaki dzień tygodnia i miesiąca opublikowano pierwszy teaser CP2077 od Platige? (np. poniedzialek15)', 'czwartek10', 0, 3, '50.060374', '19.941543', 'o4ady4lb');
INSERT INTO riddles VALUES (DEFAULT, 'W jakim mieście toczy się akcja CP2077?', 'nightcity', 0, 3, '50.055507', '19.942922', 'qkgzmvq4');
INSERT INTO riddles VALUES (DEFAULT, 'Jak ma na nazwisko modelka pozująca jako dziewczyna z ostrzami do teasera do CP2077 od Platige?', 'danysz', 0, 3, '50.053', '19.945', '59lhjwhv');
INSERT INTO riddles VALUES (DEFAULT, 'Jakie zwierzę użycza imienia tym ostrzom? (po polsku)', 'modliszka', 0, 3, '50.047', '19.947', 'l182tm65');

INSERT INTO riddles VALUES (DEFAULT, 'Jaki napis na kurtce ma dziewczyna na oficjalnym plakacie promującym styl Kitsch?', 'getrichordietrying', 0, 3, '50.054164', '19.949893', '2qansgzx');
INSERT INTO riddles VALUES (DEFAULT, 'Jaka była pierwotna data premiery CP2077? (np. 20151201)', '20200416', 0, 3, '50.055291', '19.954447', 'o1wup5l8');
INSERT INTO riddles VALUES (DEFAULT, 'Kto użyczy głosu polskiemu Johnny''emu w CP2077?', 'michalzebrowski', 0, 3, '50.057169', '19.959793', 'vj4jhlmf');
INSERT INTO riddles VALUES (DEFAULT, 'Jaką ksywkę ma postać z CP2077 nosząca na butach wiedźmińskie emblematy?', 'dex', 0, 3, '50.062368', '19.961115', 'up8zw3mz');
INSERT INTO riddles VALUES (DEFAULT, 'Ile minut trwał walkthrough CP2077 z 2018?', '48', 0, 3, '50.068', '19.953', 'yqllrwdf');

INSERT INTO riddles VALUES (DEFAULT, 'Jakiej marki samochodem porusza się V w trailerach?', 'quadra', 0, 3, '50.066622', '19.949637', 'x0tbjlnf');
INSERT INTO riddles VALUES (DEFAULT, 'W którym roku umieszczona jest akcja pierwszej papierowej gry z serii Cyberpunk?', '2013', 0, 3, '50.064568', '19.957295', 'wu0v8a4y');
INSERT INTO riddles VALUES (DEFAULT, 'Jak ma na imię znany z trailerów, wtrącający hiszpańskojęzyczne wstawki, przyjaciel V?', 'jackie', 0, 3, '50.063897', '19.946614', '3rwdter7');
INSERT INTO riddles VALUES (DEFAULT, 'Osiemset jednostek czego podał lekarz Trauma Team pacjentce NC570442? (po angielsku)', 'fibrin', 0, 3, '50.061131', '19.944445', 'v10kk5sv');
INSERT INTO riddles VALUES (DEFAULT, 'Kto będzie polskim wydawcą CP2077?', 'cenega', 0, 3, '50.060656', '19.949094', 'j4ysn01u');

INSERT INTO riddles VALUES (DEFAULT, 'W którym roku Keanu powiedział fanom, że są breathtaking?', '2019', 0, 3, '50.058545', '19.954118', '6p8ltagy');
INSERT INTO riddles VALUES (DEFAULT, 'Co chce spalić pan Silverhand?', 'miasto', 0, 3, '50.057537', '19.949193', 'y49bal76');
INSERT INTO riddles VALUES (DEFAULT, 'Na jakim paliwie jeżdżą samochody w świecie Cyberpunka?', 'chooh2', 0, 3, '50.056279', '19.953753', 'eswnet8l');
INSERT INTO riddles VALUES (DEFAULT, 'Jaki napis na kołnierzu swojej kurtki ma V?', 'samurai', 0, 3, '50.059425', '19.949119', 'zkeu8rrl');

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


--
-- use this to check for history if you wish
-- SELECT history.id, history.timestamp, history.riddle_id, teams.name FROM history INNER JOIN teams ON history.team_id = teams.id;
--
