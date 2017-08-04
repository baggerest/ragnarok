<?php
    error_reporting(0);

    $server = array(
        'user'=> 'root',
        'password' => 'root',
        'port_db' => 3306,
		'ip' => '127.0.0.1',
        'db_name' => 'ragnarok',
        'db_charset' => 'utf8',
        'db_type' => 'mysql',
        'charset_collate' => 'utf8_unicode_ci',
        'language' => strtoupper(strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',')),
    );

    header("Content-Type:text/html; charset={$server['db_charset']}");

	try
	{
		$pdo = new PDO("{$server['db_type']}:host={$server['ip']};dbname={$server['db_name']};port={$server['port_db']};charset={$server['db_charset']}",$server['user'],$server['password']);
		$pdo->query("set names utf8");
		$sth = $pdo->prepare("SELECT * FROM `char`");
		$sth->execute();

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);
		echo "<table border=1 align=center>";
		
		foreach($result as $index => $list)
		{
			if($index===0)
			{
				echo "<tr>";
				foreach($list as $name => $v)
				{
					echo "<td>$name</td>";
				}
				echo "</tr>";
			}
			
			echo "<tr>";
			foreach($list as $name => $value)
			{
				echo "<td>$value</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		
	}catch(Exception $e){
		echo $e->getMessage();
	}
