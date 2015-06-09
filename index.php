<!doctype html>

<head>
	<meta charset="utf-8">

	<title>Wheaton College Code Test</title>

	<link rel="stylesheet" href="css/style.css">


</head>
<body>

	<div class="container">
		
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
	
	<div class="urlList"></div>
	
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
			data: {
					'username': 'foo',
					'password': 'bar',
					},
			success: function( data ) {
				console.log('success');
				var items = [];
				$.each( data, function( key, val ) {
					console.log(key + ' | ' + val);
				});
				
				//this is what you get
				/*
				"success" wheaton:56:4
"code | 1" wheaton:59:5
"status | 200" wheaton:59:5
"data | ["16350","http:\/\/www.projo.com","4hhw"]"
				*/

				//$.each( data, function( key, val ) {
				//	items.push( "<li id='" + key + "'>" + val + '</li>' );
				//});
				//$( '<ul/>', {
				//	'class': 'my-new-list',
				//	html: items.join( '' )
				//}).appendTo( '.urlList' );

			},
			error: function (xhr, ajaxOptions, thrownError) {
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
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(xhr.responseText);
			},
		});
		
	});
		
});

</script>

</body>
</html>