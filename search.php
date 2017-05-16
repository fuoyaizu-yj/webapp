<?php
$searchword = $_POST['searchword'];

$headers = array("Accept: application/json","api-key: C4EB8CFFF35966AB916105796228E01B");

$query = array(
                'api-version' => '2016-09-01',
                'queryType='  => 'full',
                'search' => "'¥"".$searchword."¥"'",
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
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head> 
<body>

<h1>特集検索サンプルページ</h1>

<form class="form-inline" action="search.php" method="post">
  <div class="form-group">
    <label for="searchword">キーワード</label>
    <input type="text" class="form-control" id="searchword" name="searchword" placeholder="テレビ" value="<?php echo $searchword;?>">
  </div>
  <button type="submit" class="btn btn-default">送信</button>
</form>

<!--
<form action="search.php" method="post">
<fieldset>
キーワード：<input type="text" name="searchword" autofocus required value="<?php echo $searchword;?>"><br>
<input type="submit" value="送信">
</fieldset>
</form>
//-->
  
<?php
if (isset($result["value"]))
{
    $tmpArr = array();
    foreach($result["value"] as $v)
    {
        $imageArr = json_decode($v["Image"][0], true);
        $readArr = json_decode($v["Read"][0], true);

        $tmpArr[] = <<< EOD
<tr>
<td><img src="{$imageArr["src"]}" alt="{$imageArr["alt"]}" class="img-thumbnail"></td>
<td> {$readArr["text"]}<td>
</tr>
EOD;
    }
    $html = implode("¥n", $tmpArr);
    echo <<< EOD
<table class="table table-bordered">
{$html}
</table>
EOD;
}
?>
</body> 
</html>

