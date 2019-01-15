<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">

  <title>電子化流程設計與管理</title>
</head>

<body>

<?php
require_once(__DIR__ . "/config.php");
ini_set ("soap.wsdl_cache_enabled", "0");
$client = new SoapClient($conf['EasyFlowServer']);

if($_POST){
    if(
        !empty($_POST['oid'])
        && !empty($_POST['eid'])
        && !empty($_POST['cid'])
    ) {

        // 參數設定
        $oid = $_POST['oid'];
        $uid = $_POST['uid'];
        $eid = $_POST['eid'];
		$aid = $_POST['aid'];
		$cid = $_POST['cid'];
		$yid = $_POST['yid'];
		$zid = $_POST['zid'];
		$msg = $_POST['msg'];
		$msg0 = $_POST['msg0'];
        $msg1 = $_POST['msg1'];
		$msg2 = $_POST['msg2'];
		$msg3 = $_POST['msg3'];
		$msg4 = $_POST['msg4'];
        $num = $_POST['num'];

        // 送到流程管理
        try{
            $procesesStr = $client->findFormOIDsOfProcess($cid);

            $proceses = explode(",", $procesesStr);
            $process = $proceses[0];
            $template = $client->getFormFieldTemplate($process);

            $form = simplexml_load_string($template);
			$form->Textbox0 = $aid;
			$form->Textbox1 = $uid;
			$form->Date0 = $msg0;
			$form->Date1 = $msg1;
			$form->Time0 = $msg2;
			$form->Date2 = $msg3;
			$form->Time1 = $msg4;
            $form->Textbox2 = $msg;
			$form->RadioButton0 = $zid;
			$form->RadioButton1 = $yid;
            $form->TextArea0 = $num;

            $result = $form->asXML();
			
			
			
            $client->invokeProcess($cid, $oid, $eid, $process, $result, "伺服器代管申請作業");
			
        }catch(Exception $e){
        echo $e->getMessage();
        }

    } else {
        echo "系統錯誤";
    }
    exit;
}

?>

  <div class="container">
    <div class="py-5 text-center">
      <h2>電子化流程設計與管理</h2>
    </div>

    <div class="row">

      <div class="col-md-6 order-md-1">
        <h4 class="mb-3"></h4>
        <form class="needs-validation" method="POST" action="./index.php">
          

		  <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="oid">申請人/分機編號</label>
                  <input name="oid" type="text" class="form-control" id="oid" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>

            <div class="col-md-6 mb-3">
              <label for="eid">申請單位編號</label>
              <input name="eid" type="text" class="form-control" id="eid" placeholder="" value="" required>
              <div class="invalid-feedback">
                範例輸入 必填
              </div>
            </div>
          </div>
		  
          <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="cid">流程編號</label>
                  <input name="cid" type="text" class="form-control" id="cid" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>

            <div class="col-md-6 mb-3">
              <label for="aid">申請單位</label>
              <input name="aid" type="text" class="form-control" id="aid" placeholder="" value="" required>
              <div class="invalid-feedback">
                範例輸入 必填
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="uid">申請人/分機</label>
                  <input name="uid" type="text" class="form-control" id="uid" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>

              <div class="col-md-6 mb-3">
                  <label for="msg0">申請日期</label>
                  <input name="msg0" type="date" class="form-control" id="msg0" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>
          </div>
		  
		  <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="msg1">刊登時間</label>
                  <input name="msg1" type="date" class="form-control" id="msg1" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>
				
				<div class="col-md-6 mb-3">
				<label for="msg2"></label><br>
                  <input name="msg2" type="time" class="form-control" id="msg2" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>
          </div>
		  
		  <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="msg3">至</label>
                  <input name="msg3" type="date" class="form-control" id="msg3" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>
				
				<div class="col-md-6 mb-3">
				<label for="msg4"></label>
                  <input name="msg4" type="time" class="form-control" id="msg4" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>
          </div>
		  
          <div class="row">
              <div class="col-md-12 mb-3">
                  <label for="msg">目的</label>
                  <input name="msg" type="text" class="form-control" id="msg" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>
          </div>
		  
          <div class="row">
              <div class="col-md-12 mb-3">
                  <label for="zid">申請事項</label>
				  <dd>
                  <input type="radio" name="zid" value="1" checked="checked">Banner(1004x300像素)
                  <input type="radio" name="zid" value="2">跑馬燈
                  <input type="radio" name="zid" value="3">快速連結
				  <input type="radio" name="zid" value="4">網頁內容
				  <input type="radio" name="zid" value="5">網頁版面
				  <input type="radio" name="zid" value="6">增建帳號
				  <input type="radio" name="zid" value="7">其他
				  </dd>
                </div>
          </div>
		  
		  <div class="row">
              <div class="col-md-12 mb-3">
                  <label for="yid">協助事項</label>
				  <dd>
                  <input type="radio" name="yid" value="1" checked="checked">新增
                  <input type="radio" name="yid" value="2">修改
                  <input type="radio" name="yid" value="3">刪除
				  </dd>
                </div>
          </div>
		  
		  <div class="row">
              <div class="col-md-12 mb-3">
                  <label for="num">申請事項說明</label>
                  <input name="num" type="text" class="form-control" id="num" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    範例輸入 必填
                  </div>
                </div>
          </div>
		  
		  <div class="row">
              <div class="col-md-12 mb-3">
                  <label for="yy">注意事項</label><br>
                  1.申請事項說明以簡單扼要為原則。<br>
				  2.申請單位應負刊登文字責任。<br>
				  3.相關檔案請寄到公務信箱banner：bcoffice01@nkust.edu.tw (請在刊登日前3天寄出)。<br>
				  <center>其他： chunting@nkust.edu.tw</center>
                </div>
          </div>

          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">送出</button>
        </form>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2017-2018 NKUST MIS</p>
    </footer>
  </div>

  <!-- Bootstrap core JavaScript
        ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict';

      window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');

        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>
