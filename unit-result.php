<?php
function json_convert($file){
  $json = mb_convert_encoding(file_get_contents($file), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = json_decode($json, true);
  return $arr;
}
$unit = json_convert("./unit.json");
$fac = json_convert("./faculty.json");
$unit_req = json_convert("./unit_requirement.json");
$env = json_convert("./env.json");

$entire = array();
foreach($_REQUEST as $key => $req){
  if(gettype($req) != "array"){
    array_push($entire, $req);
  }
}
echo array_sum($entire);

echo json_encode($_REQUEST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <main class="container">
    <table>
      <thead>
        <tr>
          <th>科目群名</th>
          <th>取得単位数</th>
        </tr>
      </thead>
      <tbody>
        <?php
          for($i = 0; $i < count($env);$i++){
            foreach($_REQUEST as $key => $req){
              if($env[$i]['code'] == $key){
                echo '<tr>';
                echo '<td>'.$env[$i]['type'].'<td>';
                if(gettype($req) != "array"){
                  echo '<td class="name">'.$env[$i]['name'].'</td><td class="unit">'.$req.'</td>';
                } else {
                  echo '<td class="name" style="font-weight: bold;">'.$env[$i]['name'].'</td><td class="unit">'.array_sum($req).'</td>';
                }
                echo '</tr>';
              }
            }
          }
        ?>
      </tbody>
    </table>
    <p id="unitTotal"></p>
    <script>
      const unit = document.getElementsByClassName('unit');
      let total = [];
      for(let i = 0; i < unit.length; i++){
        let u = unit[i];
        total.push(parseInt(u.innerText));
      }
      let sum = total.reduce(function(s, e){
        return s + e;
      }, 0);
      document.getElementById('unitTotal').innerText = sum + '単位'
    </script>
  </main>
</body>
</html>