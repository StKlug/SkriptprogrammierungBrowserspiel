
$(function()
{
	var boardContent = "";
	var myTurn = true;
	for(var x = 0; x <6;x++)
	{
		boardContent += "<tr>";
		for (var y = 0; y <7; y++)
		{
			boardContent += "<td data-x='" +x + "' data-y='"+y+"' />";
		}
		boardContent += "</tr>";
	}
	$('#board').html(boardContent);
	
	/*Events */
	$('#newGameButton').click(function ()
	{
		newGame();
	});
	
	$('#board tbody tr td').click(function ()
	{
		if(!myTurn)
		{
			return;
		}
		$(this).addClass("yellow");
		myTurn = false;
		$.ajax({
    contentType: 'application/json',
    data: {
        "x": $(this).data("x"),
        "y": $(this).data("y")
    },
    dataType: 'json',
    success: function(data){
		myTurn = true;
    },
    error: function(e){
    	console.log(e);
    	alert("FAIL");
    },
    processData: false,
    type: 'POST',
    url: 'game_post.php',
    timeout: 2000
});
		
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
