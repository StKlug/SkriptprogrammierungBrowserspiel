
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
		$.post('game_post.php',{'action':'newGame'}).done(function(responseData){
            console.log(responseData);
            myTurn= true;
        });
	});
	
	$('#board tbody tr td').click(function ()
	{
		if(!myTurn)
		{
			return;
		}
		var x = $(this).data("x");
		var insertY =5;
		for(var y = 0;y <6;y++)
		{
			if($('#board tbody tr td[data-x= "'+x+'"][data-y="'+ y+ '"]').is(".yellow",".red"))
			{
				insertY = y-1;
				break;
			}
		}
		if(insertY === -1){
			return;
		}
		
		$('#board tbody tr td[data-x= "'+x+'"][data-y="'+ insertY+ '"]').addClass("yellow");
		myTurn = false;
		$.post('game_post.php',{
        'column': $(this).data("x"),
        'action' :'turn'
   		})
   		.done(function(responseData)
   		{
   			var jResponse = JSON.parse(responseData);
   			jResponse.board = eval(jResponse.board);
   			console.log(jResponse);
   			if(jResponse.message === "WON")
   			{
   				win();
   			}
   			else if(jResponse.message === "LOST")
   			{
   				lose();
   			}else if(jResponse.message === "TIE")
   			{
   				tie();
   			}else if(jResponse.message === "ILLEGAL_MOVE")
   			{
   				newGame();
   			}
   			else
   			{
   				fillBoard(jResponse.board);
   				myTurn = true;
   			}
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
	$('#main-content div.message').remove();
	$('#board tbody tr td').removeClass("yellow red");
	
}
function fillBoard(myval)
{
	for(var y = 0; y <6;y++)
	{
		for (var x = 0; x <7; x++)
		{
			var element = $('#board tbody tr td[data-x= "'+x+'"][data-y="'+ y+ '"]');
			element.removeClass("yellow","red");
			if(myval[x][y] === 1)
			{
				element.addClass("yellow");
			}
			 else if(myval[x][y] === 2)
			{
				element.addClass("red");
			}
		}
	}
}

function win(){
	var winMsg = $('<div class="message win">Gewonnen!</div>');
	winMsg.hide();	
	$("#main-content").append(winMsg);
	
	$('#board').fadeOut();
	winMsg.fadeIn();
}
function lose()
{
	var winMsg = $('<div class="message lose">Verloren!</div>');
	winMsg.hide();	
	$("#main-content").append(winMsg);
	
	$('#board').fadeOut();
	winMsg.fadeIn();	
}

function tie()
{
	var winMsg = $('<div class="message">Unentschieden</div>');
	winMsg.hide();	
	$("#main-content").append(winMsg);
	
	$('#board').fadeOut();
	winMsg.fadeIn();		
}
