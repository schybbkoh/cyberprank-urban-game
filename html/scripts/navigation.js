function navigate(latitude, longitude) {
    if(/Android/i.test(navigator.userAgent)) {
	// android
	var link_to_map = '<a href="geo:' + latitude + ',' + longitude + '?q=' + latitude + ',' + longitude + '(zagadka)' + ';">KLIKNIJ TUTAJ, ABY OTWORZYĆ NAWIGACJĘ (ANDROID)</a>';
    } else if(/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
	// ios
//      one of the following should work, however it seems that there are problems and since I have neither an iDevice at home nor time to debug...
//      so screw Apple, a regular link would have to suffice
//      var link_to_map = '<a href="comgooglemapsurl://www.google.com/maps/dir/' + latitude + ',' + longitude + ';">KLIKNIJ TUTAJ, ABY OTWORZYĆ NAWIGACJĘ (APPLE)</a>';
//      var link_to_map = '<a href="comgooglemaps://daddr=' + latitude + ',' + longitude + '&directionsmode=transit' + ';">KLIKNIJ TUTAJ, ABY OTWORZYĆ NAWIGACJĘ (APPLE)</a>';
//      var link_to_map = '<a href="https://maps.apple.com/maps/place/' + latitude + ',' + longitude + ';">KLIKNIJ TUTAJ, ABY OTWORZYĆ NAWIGACJĘ (APPLE)</a>';
        var link_to_map = '<a href="http://www.google.com/maps/place/' + latitude + ',' + longitude + '"' + 'target="_blank">KLIKNIJ TUTAJ, ABY OTWORZYĆ LINK DO MAPY (może nie działać na iPhone)</a>';
    } else {
	// other mobile or desktop
	var link_to_map = '<a href="http://www.google.com/maps/place/' + latitude + ',' + longitude + '"' + 'target="_blank">KLIKNIJ TUTAJ, ABY OTWORZYĆ GOOGLE MAPS (PRZEGLĄDARKA)</a>';
    }
    document.getElementById("navigation").innerHTML = link_to_map;
}
