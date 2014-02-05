<?php
require_once 'php5/KalturaClient.php';

define("KALTURA_SECRET", "code");
define("KALTURA_PARTNER", "number");
define("KALTURA_USERID", "email");


$config = new KalturaConfiguration(KALTURA_PARTNER);
$config->serviceUrl = "http://kmc.smartcast.com.mx";
// $config->serviceUrl = "http://smartcast.com.mx/";
$client = new KalturaClient($config);
$ks = $client->generateSession(KALTURA_SECRET, KALTURA_USERID, KalturaSessionType::ADMIN, KALTURA_PARTNER);
$client->setKs($ks);

$uploadToken = new KalturaUploadToken();
$result = $client->uploadToken->add($uploadToken);
$uploadTokenId = $result->id;
$up = true;

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>upload</title>


  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/jquery.form.js"></script>

</head>
<body>
  
</body>
</html>

	<div class="grid-6">
		<form id="myForm" action="http://kmc.smartcast.com.mx/api_v3/index.php?service=uploadToken&action=upload&format=1" method="post" enctype="multipart/form-data">
          <input type="text" name="ks" value="<?php echo $ks; ?>" class="dnone"/>
          <input type="text" name="uploadTokenId" value="<?php echo $uploadTokenId; ?>" class="dnone"/>

          <input type="file" size="60" name="fileData" class="button big">
          <input type="submit" value="Upload" class="button big arrowup">

		 </form>

    <div class="progress bar5">
        <span class="blue" style="width: 0%;"><span>0%</span></span>
    </div>

		<h3>Title:</h3>
		<input type="text" name="title" class="grid-12">

		<h3>Description:</h3>
		<textarea name="desc" id="desc" cols="30" rows="5" class="grid-12"></textarea>

		<h3>Categories:
			<button class="md-trigger button big" data-modal="modal-3">+</button>
			<!-- <button class="md-trigger button big" data-modal="modal-1">+</button> -->
		</h3>
		<input type="text" name="cat" class="grid-12">

		<h3>Tags:</h3>
		<input type="text" name="tags" class="grid-12" placeholder="Tags ( Example: Car, Drive, Tv, Festival... )">
		
		<br>
		<button class="SaveUT button big">Save Info</button>
	</div> 


<br/>
    
<div id="message"></div>
