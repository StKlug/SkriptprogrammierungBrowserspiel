<strong>
	<p>Nick: {$nick}</p>
	<p>Punktestand: {$points}</p>
</strong>
<form action="profil.php" method="get">
	<input type="submit" value="Nachricht senden"/><input type="hidden" name="send" value="true"/>
</form>
	<p><textarea name="beschreibung" cols="80" rows="20" readonly>{$beschr}</textarea></p>
