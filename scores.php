<?php
	require_once 'lib/Template.class.php';
	require_once 'lib/Database.class.php';
	$tpl = new Template();

	$page = 1;
	$pagecount = 1;

	if(isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$page = (int)$_GET['page'];
		if ($page < 1) {
			$page=1;
		}
	}

	$db = Database::getInstance();

	$query = $db->query("SELECT COUNT(1) as 'count' FROM user");
	$row = $query->fetch();
	$count = $row['count'];

	if($count%10 == 0)
	{
		$counttemp = $count-1;
		if(($counttemp/10)+1 < $page){
		$page = 1;
		}
		$pagecount = (int)$count/10;
	}
	else{
		$pagecount = (int)$count/10;
		if(($count/10+1) < $page){
			$page = 1;
		}
	}

	$table = 'Seite '. $page .'<br><br><table border rules=all"><tr><th>User</th><th>Points</th></tr>';

	$resultset = $db->query("SELECT * FROM user ORDER BY points DESC");
	$counter = 0;
	$pagecounter = 0;
	foreach ($resultset as $row) {
		if($page*10-10+$pagecounter == $counter){
			$table = $table.'<tr><td width="80%"><a href="profil.php?email=' . $row['email'] . '">' . $row['nick'] . '</a></td><td>' . $row['points'] . '</td></tr>';
			if($pagecounter < 9){
				$pagecounter++;
			}
		}
		$counter++;
	}

	$table = $table . '</table><br>';
	
	if($page != 1){ //Nach links
		$page--;
		$table = $table . '<a href="scores.php?page='. $page .'"><img style="float: left; margin-left: 30px;" src="images/goleft.png"></a>';
		$page++;
	}
	if($pagecount > $page){ //Nach rechts
		$page++;
		$table = $table . '<a href="scores.php?page='. $page .'"><img style="float: right; margin-right: 30px;" src="images/goright.png"></a>'; 
	}

	$tpl->assign('table', $table);
	$tpl->display('templates/scores.tpl');
?>