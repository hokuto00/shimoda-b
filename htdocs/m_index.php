<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <script type='text/javascript' src='//maps.google.com/maps/api/js?key=AIzaSyDkMRdJHpA_aBwVMFa50ZoCiOom-LawKAQ'></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

<html>
  <body>
    <div id="map"></div>

    <?php
        require("m_config.php");
        // Select all the rows in the markers table
        try{
          $sql = "select * from markers where 1";
          $result = $pdo->query($sql);
          $row = $result->fetchall();
          $rowJson = json_encode($row);
        }
        catch(PDOException $e){
          die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    ?>

    <script>
let row = <?php echo $rowJson?>;

function map_canvas() {
//マーカーの情報
var data = new Array();
var data_length= <?php echo $result->rowCount(); ?>;

for (i = 0; i < data_length; i++) {
  data.push({
      lat: row[i][3], //緯度
      lng: row[i][4], //経度
      url: row[i][6] //リンク先
  });

}

//初期位置に、上記配列の一番初めの緯度経度を格納
  var latlng = new google.maps.LatLng(data[0].lat, data[0].lng);
  
  var opts = {
    zoom: 17,//地図の縮尺
    center: latlng, //初期位置の変数
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
  
//地図を表示させるエリアのidを指定
  var map = new google.maps.Map(document.getElementById("map"), opts);
  
//マーカーを配置するループ
  for (i = 0; i < data.length; i++) {
    var markers = new google.maps.Marker({
      position: new google.maps.LatLng(data[i].lat, data[i].lng),
      map: map
    });
    //クリックしたら指定したurlに遷移するイベント
    google.maps.event.addListener(markers, 'click', (function(url){
      return function(){ location.href = url; };
    })(data[i].url));
  }
}
  
//地図描画を実行
google.maps.event.addDomListener(window, 'load', map_canvas);
    </script>
  </body>
</html>