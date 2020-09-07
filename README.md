# cyberprank-urban-game

This repo contains code used for an urban game (Cyberpunk 2077 theme) I organised with my friends.
The general idea was for people to solve riddles which would give them coordinates and those would then lead people to tokens hidden around the city. Registering a token would score a point for your team.

The code was meant to be quick to develop, so it's rather dirty and full of security weaknesses. It's also my first time ever with PHP so no miracles are to be expected. No automation was also prepared, so installation would require some manual work (you will figure it out):
- create a PostgreSQL database and user
- modify SQL script according to your needs
- run SQL against the database
- modify PHP connection strings to reflect database credentials
- copy website files to a webserver of your choice (ie. nginx + php-fpm)
- have fun

I was running the game using:
- Cloudflare as a front
- ElephantSQL as database provider
- local storage provider for webserver
