<?php
function json_convert($file)
{
  $json = mb_convert_encoding(file_get_contents($file), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = json_decode($json, true);
  return $arr;
}
$unit = json_convert("./unit.json");
$fac = json_convert("./faculty.json");
$unit_req = json_convert("./unit_requirement.json");
if (isset($_GET['dept'])) {
  $dept = $_GET['dept'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-light bg-light mb-5">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">単位計算機</span>
    </div>
  </nav>
  <div class="container">
    <?php if (empty($dept)) { ?>
      <form action="" name="deptSelectForm">
        <?php foreach ($fac as $index => $f) {
          if ($f['isEnabled'] < 1) {
            continue;
          }
          echo '<div class="form-check">';
          echo '<label class="form-check-label col-auto"><input class="form-check-input" value="' . $index . '" type="radio" name="dept">' . $f['name'] . '</label>';
          echo '</div>';
        } ?>
        <button type="submit" class="btn btn-primary mt-2">設定する</button>
      </form>
    <?php } else { ?>
      <?php if ($dept < count($fac)) { ?>
        <?php if (!empty($fac[$dept]) & $fac[$dept]['isEnabled'] > 0) { ?>
          <form action="./unit-result.php" method="POST" name="unitForm">
            <div id="entire">
              <h1>教養科目</h1>
              <section class="main_section">
                <h2>必修</h2>
                <div class="section_content">
                  <h3 class="subject-name">基軸教育科目</h3>
                  <div class="row">
                    <div class="col">
                      <label for="core-english" class="form-label">英語(計2単位)</label>
                      <select class="form-select" name="core-english" id="core-english">
                        <?php for ($i = 0; $i < 3; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="core-foreignlang" class="form-label">初修外国語(計2単位)</label>
                      <select class="form-select" name="core-foreignlang" id="core-foreignlang">
                        <?php for ($i = 0; $i < 3; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="core-carrier" class="form-label">キャリア形成科目(1単位)</label>
                      <select class="form-select" name="core-carrier" id="core-carrier">
                        <?php for ($i = 0; $i < 2; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                  </div>
                  <h3 class="subject-name">現代教養科目</h3>
                  <div class="row">
                    <div class="col">
                      <label for="core-liberalhumanity" class="form-label">個別分野科目(人文・社会分野)(4単位)</label>
                      <select class="form-select" name="core-liberalhumanity" id="core-liberalhumanity">
                        <?php for ($i = 0; $i < 5; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="core-liberalscience" class="form-label">個別分野科目(自然科学分野)(4単位)</label>
                      <select class="form-select" name="core-liberalscience" id="core-liberalscience">
                        <?php for ($i = 0; $i < 5; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="col">
                      <label for="core-interdisciplinaryregion" class="form-label">学際科目(地域志向科目)(2単位)</label>
                      <select class="form-select" name="core-interdisciplinaryregion" id="core-interdisciplinaryregion">
                        <option value="0" selected>未修得</option>
                        <option value="2">修得済</option>
                      </select>
                    </div>
                    <div class="col">
                      <label for="core-interdisciplinary" class="form-label">学際科目(地域志向科目以外)(2単位)</label>
                      <select class="form-select" name="core-interdisciplinary" id="core-interdisciplinary">
                        <option value="0" selected>未修得</option>
                        <option value="2">修得済</option>
                      </select>
                    </div>
                  </div>
                </div>
              </section>
              <section class="main_section">
                <div class="section_title">
                  <h2>選択</h2>
                </div>
                <div class="section_content">
                  <h3 class="subject-name">基軸教育科目</h3>
                  <div class="subject-cont row">
                    <div class="subject col">
                      <label for="english" class="form-label">英語</label>
                      <select class="form-select" name="english" id="english">
                        <?php for ($i = 0; $i < 3; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="subject col">
                      <label for="freshmen-seminar" class="form-label">新入生セミナー(2単位)</label>
                      <select class="form-select" name="freshmen-seminar" id="freshmen-seminar">
                        <option value="0">未修得</option>
                        <option value="2" selected>修得済</option>
                      </select>
                    </div>
                  </div>
                  <h3 class="subject-name">その他</h3>
                  <div class="subject-cont row">
                    <div class="subject col">
                      <label for="information" class="form-label">情報処理(2単位)</label>
                      <select class="form-select" name="information" id="information">
                        <option value="0" selected>未修得</option>
                        <option value="2">修得済</option>
                      </select>
                    </div>
                    <div class="subject col">
                      <label for="sel-english" class="form-label">英語(6単位まで)</label>
                      <select class="form-select" name="sel-english" id="sel-english">
                        <?php for ($i = 0; $i < 7; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="subject col">
                      <label for="sel-foreignlang" class="form-label">初修外国語(8単位まで)</label>
                      <select class="form-select" name="sel-foreignlang" id="sel-foreignlang">
                        <?php for ($i = 0; $i < 9; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="subject col">
                      <label for="pe" class="form-label">健康体育(4単位まで)</label>
                      <select class="form-select" name="pe" id="pe">
                        <?php for ($i = 0; $i < 5; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="subject col">
                      <label for="sel-liberal" class="form-label">個別分野科目(4単位まで)</label>
                      <select class="form-select" name="sel-liberal" id="sel-liberal">
                        <?php for ($i = 0; $i < 5; $i++) {
                          if ($i === 0) {
                            echo '<option value="0">未修得</option>';
                          } else {
                            echo '<option value="' . $i . '">' . $i . '単位</option>';
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="subject col">
                      <label for="sel-interdisciplinary" class="form-label">学際科目(2単位まで)</label>
                      <select class="form-select" name="sel-interdisciplinary" id="sel-interdisciplinary">
                        <option value="0" selected>未修得</option>
                        <option value="1">1単位</option>
                        <option value="2">2単位</option>
                      </select>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <div id="faculty">
              <h1><?= $fac[0]['name'] ?></h1>
              <div class="row">
                <div class="col">
                  <h2>必修</h2>
                  <div class="subject">
                    <select class="form-select" name="facRequired[]" id="fac-required" multiple required>
                      <?php foreach ($unit as $u) { ?>
                        <?php if ($u['type'] == 'facRequired') { ?>
                          <?= '<option value="' . $u['unit'] . '">' . $u['name'] . ' (' . $u['unit'] . '単位)</option>' ?>
                        <?php }; ?>
                      <?php }; ?>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <h2>選択</h2>
                  <div class="subject">
                    <select class="form-select" name="facSelect[]" id="fac-select" multiple required>
                      <?php foreach ($unit as $u) { ?>
                        <?php if ($u['type'] == 'facSelect') { ?>
                          <?= '<option value="' . $u['unit'] . '">' . $u['name'] . ' (' . $u['unit'] . '単位)</option>' ?>
                        <?php }; ?>
                      <?php }; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div id="department">
              <h1><?= $fac[$dept]['name'] ?></h1>
              <div class="row">
                <div class="col">
                  <h2>必修</h2>
                  <div class="subject">
                    <select class="form-select" name="deptRequired[]" id="dept-required" multiple required>
                      <?php foreach ($unit as $u) { ?>
                        <?php if ($u['type'] == 'deptRequired' && $u['dept'] == $dept) { ?>
                          <?= '<option value="' . $u['unit'] . '">' . $u['name'] . ' (' . $u['unit'] . '単位)</option>' ?>
                        <?php }; ?>
                      <?php }; ?>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <h2>選択必修</h2>
                  <?php foreach (array_keys($unit_req[$dept]['deptSelectRequired']) as $index => $key) { ?>
                    <label for="dept-selectrequired<?= ($index + 1) ?>"><?= '選択必修' . ($index + 1) ?></label>
                    <select class="form-select" name="deptSelectRequired<?= ($index + 1) ?>[]" id="dept-selectrequired<?= ($index + 1) ?>" multiple required>
                      <?php foreach ($unit as $u) { ?>
                        <?php if ($u['type'] == $key && $u['dept'] == $dept) { ?>
                          <?= '<option value="' . $u['unit'] . '">' . $u['name'] . ' (' . $u['unit'] . '単位)</option>' ?>
                        <?php }; ?>
                      <?php }; ?>
                    </select>
                  <?php }; ?>
                </div>
                <div class="col">
                  <h2>選択</h2>
                  <div class="subject">
                    <select class="form-select" name="deptSelect[]" id="dept-select" multiple required>
                      <?php foreach ($unit as $u) { ?>
                        <?php if ($u['type'] == 'deptSelect' && $u['dept'] == $dept) { ?>
                          <?= '<option value="' . $u['unit'] . '">' . $u['name'] . ' (' . $u['unit'] . '単位)</option>' ?>
                        <?php }; ?>
                      <?php }; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">計算する</button>
          </form>
        <?php } else { ?>
          <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">計算対象外の学科が指定されました。</h4>
            <p class="mb-0">現在、<strong><?= $fac[$dept]['name'] ?></strong>は計算対象外の学科に設定されています。</p>
          </div>
          <button class="btn btn-primary" onclick="location.href = './'">学科選択画面に戻る</button>
        <?php } ?>
      <?php } else { ?>
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">存在しない学科が指定されました。</h4>
          <p class="mb-0">ドーナツの穴は食べられません。</p>
        </div>
        <button class="btn btn-primary" onclick="location.href = './'">学科選択画面に戻る</button>
      <?php } ?>
    <?php } ?>
  </div>
</body>

</html>