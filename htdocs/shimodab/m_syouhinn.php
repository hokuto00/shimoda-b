<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>飲み物一覧</title>
	</head>
	<body>
		<?php
			require_once '_database_conf.php';
			require_once '_h.php';
			try
			{
				$pro_nomimono=$_GET['pronomimono'];

				$db = new PDO($dsn, $dbUser, $dbPass);
				$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql='SELECT * FROM `mst_beverage` WHERE code_drink=:nomimono';
				$stmt=$db->prepare($sql);
				$stmt->bindValue(':nomimono', $pro_nomimono, PDO::PARAM_INT);
				$stmt->execute();

				$db=null;

				print '飲み物情報<br /><br />';
				

				while(true)
				{
					$rec=$stmt->fetch(PDO::FETCH_ASSOC);
					if($rec==false)
					{
						break;
					}
					//$_SESSION['code_vmachine'] = "$pro_code";

					//$pro_name = $rec['name_drink'];
					//$pro_price = $rec['code_drink'];
					print '飲み物名:';
					print h($rec['name_drink']).' <br/> ';
					print '飲み物情報:';
					print h($rec['data_drink']).' <br/> ';
					print '飲み物イメージ:';
					if($rec['image_drink']=='')
					{
						$disp_gazou='';
					}
					else{
						$disp_gazou='<img src="./gazou/'.$rec['image_drink'].'" height="50">';
					}
					print $disp_gazou;
					print '<br /><br /><br />';
				}

	

			

				print '<br />';
				print '<form method="get" action="m_jihannki_itiran.php">';
				print '自販機情報：名前';
				print '<input type="text" name="proname" style="width:100px">';
				print '<input type="submit" value="決定">';
				print '</form>';

				
			}
			catch (Exception $e)
			{
				echo 'エラーが発生しました。内容: ' . h($e->getMessage());
				 exit();
				 
			}
		?>
		
		<input type="button" onclick="history.back()" value="戻る"><br/><br/>


	</body>
</html>