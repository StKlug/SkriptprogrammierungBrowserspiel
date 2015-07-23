<form action="sendMessage_post.php" method="post">
    Absender: {$sender} <br />
    Empfänger Email: <input type="text" name="receiver" /><br/><br/>
    <textarea rows="8" cols="50" name="message" ></textarea><br/><br/>
    <input type="submit" value="Submit"/>
</form>
<div id="output"></div>