<br>
<br>
<div align="center">
	<h2>Ihre Nachrichten</h2>
	<a href="readMessage.php"><img style="float: right; margin-right: 40px; margin-left: 40px;" src="images/refresh.png"></a>
	<br>
	<br>
	{$message}
	
	<script type="text/javascript">
		$( "td div img" ).click(function(){
			alert($(this).data("email"));

			$.ajax({
				type: "POST",
				url: "updateReceiver.php",
				data: { 'email': $(this).data("email") },
				cache: false,
				uccess: function()
				{
					alert("Order Submitted");
				}
			});
			window.location.href = "sendMessage.php";
		});
	</script>
</div>