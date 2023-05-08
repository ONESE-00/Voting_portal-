$(document).ready(function() {
	// Listen for changes to the building name input field
	$('#buildingName').on('input', function() {
		var buildingName = $(this).val();

		// Send an AJAX request to get suggestions for the building name
		$.ajax({
			url: 'get_suggestions.php',
			type: 'GET',
			data: {buildingName: buildingName},
			success: function(suggestions) {
				// Populate the suggestions list with the returned data
				$('#buildingNameSuggestions').html(suggestions);
			}
		});

		// Disable the apartment unit field until a building name is selected
		$('#apartmentUnit').prop('disabled', true);
	});

	// Listen for changes to the building name selection
	$(document).on('click', '.building-name-suggestion', function() {
		var buildingName = $(this).text();

		// Send an AJAX request to get the apartment units for the selected building
		$.ajax({
			url: 'get_apartment_units.php',
			type: 'GET',
			data: {buildingName: buildingName},
			success: function(apartmentUnits) {
				// Populate the apartment unit dropdown with the returned data
				$('#apartmentUnit').html(apartmentUnits).prop('disabled', false);
			}
		});
	});
});
