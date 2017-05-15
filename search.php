<?php
$searchword = $_POST['searchword'];
var_dump($searchword);

$headers = array("Accept: application/json","api-key: C4EB8CFFF35966AB916105796228E01B");

$query = array(
                'api-version' => '2016-09-01',
                'search' => "'".$searchword."'",
            );

$url = "https://test-fuoyaizu.search.windows.net/indexes/temp/docs?".http_build_query($query);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 暫定対応
$response =  curl_exec($ch);

$result = json_decode($response, true);


curl_close($ch);
?>
<!DOCTYPE html> 
<html> 
<head> 
<meta charset="UTF-8">
<title>特集検索サンプルページ</title> 
</head> 
<body>

<h1>特集検索サンプルページ</h1>
<form action="search.php" method="post">
<fieldset>
キーワード：<input type="text" name="searchword" autofocus required><br>
<input type="submit" value="送信">
</fieldset>
</form>
<?php
var_dump($result);
?>
</body> 
</html>

