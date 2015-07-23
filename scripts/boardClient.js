
$(function()
{
	var boardContent = "";
	var myTurn = true;
	for(var y = 0; y <6;y++)
	{
		boardContent += "<tr>";
		for (var x = 0; x <7; x++)
		{
			boardContent += "<td data-x='" +x + "' data-y='"+y+"' />";
		}
		boardContent += "</tr>";
	}
	$('#board').html(boardContent);
	$('#board').hide();
	/*Events */
	$('#newGameButton').click(function ()
	{
		$('#board').show();
		newGame();
		$.post('game_post.php',{'action':'newGame'}).done();
	});
	
	$('#board tbody tr td').click(function ()
	{
		if(!myTurn)
		{
			return;
		}
		var mydata = JSON.stringify({
        'x': $(this).data("x"),
        'y': $(this).data("y")
   		});
   		console.log(mydata);
   
		$(this).addClass("yellow");
		myTurn = false;
		$.post('game_post.php',{
        'column': $(this).data("x"),
        'action' :'turn'
   		})
   		.done(function(responseData)
   		{
   			myTurn = true;
   			
   		});
   		
		/*
		$.ajax({
    data: JSON.stringify({
        'x': $(this).data("x"),
        'y': $(this).data("y")
   		}),
    success: function(data){
		myTurn = true;
    },
    error: function(e){
    	console.log(e);
    	alert("FAIL");
    },
    type: 'POST',
    url: 'game_post.php',
    timeout: 2000
});*/
		
	});
});
function newGame()
{
	
	$('#board tbody tr td').removeClass("yellow red");
/*	$.ajax("Game.php")(
		{
			contentType :"application/json",
			data : 
			{
				"newGame": true
			},
			dataType :"json"
		}
	);
	*/
	
}
