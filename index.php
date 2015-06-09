<!doctype html>

<head>
	<meta charset="utf-8">

	<title>Wheaton College Code Test</title>

	<link rel="stylesheet" href="css/style.css">


</head>
<body>

	<div>
		
		<h1>Create a Short URL</h1>
		
		<!--
		<form method="post" action="api.php?method=hello">
			
			<input type="hidden" name="username" value="fofo" >
			<input type="hidden" name="password" value="bar" >
			
			<input type="submit" value="Send Request" />
		</form>
		-->


	<label for="txtUrl">Enter a URL to be shortened.</label><br />
	<input type="text" id="url" name="url" value="http://www.projo.com" maxlength="200" />
	
	<button type="button" id="shorten">Go</button>
	
	<button type="button" id="retrieve">retrieve</button>
	</div>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
$(document).ready(function(){
	
	var url = $('#url').val();
	
	$('#shorten').on('click', function(){
		
		$.ajax({
			url: 'api.php?method=' + url,
			type: 'POST',
			//xhrFields: {withCredentials: true},
			data: {
					'username': 'foo',
					'password': 'bard',
					},
			success: function( data ) {
				console.log('success');
				//var items = [];
				//$.each( data, function( key, val ) {
				//	items.push( "<li id='" + key + "'>" + val + '</li>' );
				//});
				//$( '<ul/>', {
				//	'class': 'my-new-list',
				//	html: items.join( '' )
				//}).appendTo( 'body' );

			},
			error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
				console.log(xhr.status);
				console.log(xhr.responseText);
			},
		});

	});
	
	$('#retrieve').on('click', function(){
		
		var recordId = 1;
		
		$.ajax({
			url: 'api.php?method=' + recordId,
			type: 'GET',
			success: function( data ) {
				var items = [];
				$.each( data, function( key, val ) {
					items.push( "<li id='" + key + "'>" + val + '</li>' );
				});
				$( '<ul/>', {
					'class': 'my-new-list',
					html: items.join( '' )
				}).appendTo( 'body' );
				//});
			},
			error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
				console.log(xhr.status);
				console.log(xhr.responseText);
			},
		});
		
	});
		
});

</script>

</body>
</html>