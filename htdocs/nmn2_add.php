<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>リクエスト入力</title>
	</head>
	<body>
		<?php
	require_once 'request_common2.php';

	print '<br />';
	print '<form method="get" action="nmn2_add_check.php">';
	print 'リクエスト商品：番号';
	//プルダウンメニュー
	pulldown_disp();
	print '<input type="submit" value="決定">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';

	


		?>
	</body>
</html>
