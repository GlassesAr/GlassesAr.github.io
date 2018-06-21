<?

				$user = "a232223_1";
				$pass ="Pu9udp8VKF54";
				

				try {
				    $dbh = new PDO('mysql:host=a232223.mysql.mchost.ru;dbname=a232223_1',$user, $pass);
				} catch (PDOException $e) {
				    die('Подключение не удалось: ' . $e->getMessage());
				}

				$ArrCatalog;
				foreach ($dbh->query('Select * from Tovar') as $key=> $val) {
					$ArrCatalog[] = array(
											'ID'=> $val['ID'],
											'NAME'=> $val['NAME'],
											'CODE'=> $val['CODE'],
											'SRC_IMAGE'=> $val['SRC_IMAGE'],
											'SRC_JSON'=> $val['SRC_JSON'],
											'PRICE'=> $val['PRICE']
										);
				}

				foreach ($dbh->query('Select * from img') as $key=> $val) {
					$arImg[$val['id']][] = $val['src'];
				}

?>