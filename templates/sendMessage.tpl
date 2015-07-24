<form action="sendMessage_post.php" method="post">
    Absender: {$sender} <br>
    Empfänger Email:
    <select name="receiver" size="1" value="{$mail}">
	    {$options}
	</select> 
	<br>
    <textarea rows="8" cols="50" name="message" ></textarea><br><br>
    <input type="submit" value="Senden"/>
</form>
<div id="output"></div>