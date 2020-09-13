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

*edit*
My thoughts, todos and players' feedback after we played the game. It's likely that the following will never get done / implemented, but I feel it's still worth noting them down:
- make the interface mobile-friendly, as it's mobiles that people are playing on
- make sure ALL features are working properly on both Android and iOS (screw you, Apple)
- ditch iframes in favor of a more modern and civilised solution (ie. Ajax)
- improve quality of the code in general
- either make coordinates very accurate (six decimals at least) or add location hints to every riddle (ie. "you can find the token by a bench")
- for a game played on foot, a radius of 750m (1000m tops) seems reasonable, 1200-1500m is too big
- 150-180 minutes of gameplay seem reasonable
- teams of 3 seem like a good idea (or teams of 4 if you want to hint that it'd be a good idea to divide and conquer)
- consider moving part of the infra (webserver and db) from a local provider to GCP or AWS (Azure = meh); while costs will remain similar, you'll get all the flexibility you can imagine
