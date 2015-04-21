$( function () {
	function retriveInfoFromDB() {
		var url = "./../talent.json";
		function success (data) {
			console.log(url);
			$('#university').val("Hi");
		}

		$.ajax( {
			url: url,
			success: success
		});
	}

	retriveInfoFromDB();
});