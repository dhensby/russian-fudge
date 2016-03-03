var $ = window.jQuery;

$('.js-places-search-form').each(function() {
	var $form = $(this);
	var $searchBox = $form.find('.js-place-title:input');
	var $loader = $form.find('.js-loader');
	var $resultsHolder = $form.find('.js-results');
	var $map = $form.find('.js-dud-map');
	var $idField = $form.find('.js-place-id');

	var map = new google.maps.Map($map[0]);

	$map.hide();

	$loader.hide();
	var placeService = new google.maps.places.PlacesService(map);

	$searchBox.on('keyup', _.debounce(function() {
		if ($searchBox.val()) {
			placeService.textSearch({
				'query': $searchBox.val(),
				'location': new google.maps.LatLng(51.506232, -0.071207),
				'radius': 5000,
				'types': [
					'bakery',
					'bar',
					'cafe',
					'food',
					'grocery_or_supermarket',
					'meal_delivery',
					'meal_takeaway',
					'restaurant'
				]
			}, function (results, status) {
				switch (status) {
					case google.maps.places.PlacesServiceStatus.ZERO_RESULTS:
						$resultsHolder.html('<b>No results</b>');
						break;
					case google.maps.places.PlacesServiceStatus.OK:
						var htmlParts = ['<ol>'];
						_.each(results, function (result) {
							htmlParts.push('<li><a class="js-place-item" href="#" data-id="' + result.place_id + '">' + result.name + '</a></li>');
						});
						htmlParts.push('</ol>');
						$resultsHolder.html(htmlParts.join(''));
						break;
					default:
						console.error('whoops', arguments);
				}
				$loader.hide();
			});
		}
		$loader.hide();
	}, 500)).on('keydown', function() {
		$loader.show();
	});

	$resultsHolder.on('click', '.js-place-item', function(ev) {
		ev.preventDefault();
		$idField.val($(this).data('id'));
		$form.submit();
	});

});


$('.js-map').each(function() {
	var $map = $(this);
	var map = new google.maps.Map($map[0]);
})
