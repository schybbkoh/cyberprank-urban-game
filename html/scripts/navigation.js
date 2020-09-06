function navigate(latitude, longitude) {
    if(/Android/i.test(navigator.userAgent)) {
	// android
	var link_to_map = '<a href="geo:' + latitude + ',' + longitude + '?q=' + latitude + ',' + longitude + '(zagadka)' + ';">KLIKNIJ TUTAJ, ABY OTWORZYĆ NAWIGACJĘ (ANDROID)</a>';
    } else if(/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
	// ios
	var link_to_map = '<a href="comgooglemapsurl://www.google.com/maps/dir/' + latitude + ',' + longitude + ';">KLIKNIJ TUTAJ, ABY OTWORZYĆ NAWIGACJĘ (APPLE)</a>';
    } else {
	// other mobile or desktop
	var link_to_map = '<a href="http://www.google.com/maps/place/' + latitude + ',' + longitude + '"' + 'target="_blank">KLIKNIJ TUTAJ, ABY OTWORZYĆ GOOGLE MAPS (PRZEGLĄDARKA)</a>';
    }
    document.getElementById("navigation").innerHTML = link_to_map;
}