<?php

	//ini_set('error_reporting', E_ERROR & ~E_WARNING);
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);
	ini_set('log_errors', 1);
	ini_set('error_log', 'php-error.log');
	error_log( ' - - - - - - - - - - - - - - - - ' );

	session_start();

	//unset($_SESSION['token']);
	//echo '<br>';
	//print_r($_SESSION);

	//echo __DIR__;
	include_once('includes/dbtools.inc.php');
	$obj = new DbTools;
	if (!@$_SESSION['token']) {
		if($obj->createToken()) {
			//echo '<br>token created';
		} else {
			echo '<br>error, token not created';
		}
	} else {
		if ($obj->checkToken($_SESSION['token'])) {
			//is okay
		} else {
			echo '<br>error, no token found';
		}
	}
	//die();
?>

<html>

<head>
  <title>Ambiarc</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" media="all" href="TemplateData/css/bootstrap.css" />
  <link rel="stylesheet" media="all" href="css/demo-ui.css" />
  <link rel="stylesheet" media="all" href="css/tab_style.css?nc=<?php echo time(); ?>" />
  <link rel="stylesheet" media="all" href="css/menu.css?nc=<?php echo time(); ?>" />
  <link rel="stylesheet" media="all" href="css/pop_maps.css?nc=<?php echo time(); ?>" />

  <link href="css/jquery.virtual_keyboard.css" rel="stylesheet" type="text/css"/>

  <script src="js/demo-ui.js?nc=<?php echo time(); ?>"></script>

  <script src="TemplateData/js/jquery-2.2.4.min.js"></script>
  <script src="TemplateData/js/bootstrap.min.js"></script>
  <script src="js/menu.js?nc=<?php echo time(); ?>"></script>
  <script src="js/jquery.cookie.js?nc=<?php echo time(); ?>"></script>

  <script src="js/jquery.virtual_keyboard.js" type="text/javascript"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script>
    	//document.token = "<?php echo $_SESSION['token'] ?>";
    	var acad = '<?php $obj->fetchAcademicsArray() ?>';
    	document.acad = JSON.parse(acad);
    	var off = '<?php $obj->fetchOfficesArray() ?>';
    	document.off = JSON.parse(off);
    	var fac = '<?php $obj->fetchFacilitiesArray() ?>';
    	document.fac = JSON.parse(fac);
    	$.cookie('token', "<?php echo $_SESSION['token'] ?>", { expires: 1, secure: false });
    	//$.cookie('token', token, { expires: 1, path: '/', domain: 'jquery.com', secure: true });
    </script>

  <script src="GettingStartedComplete.js?nc=<?php echo time(); ?>"></script>

  <style></style>

</head>

<body style="pointer-events:none">


  <div id="bootstrap" hidden>
    <div class="container-fluid" style="z-index:100;">
      <!--<div class="row">
        <div style="pointer-events: all">
          <div id="levels-dropdown" class="dropdown floor-selector">
            <button id="#levels-dropdown-button" onclick="dropdownClicked();" class="btn btn-default dropdown-toggle ui-item" type="button" aria-haspopup="true" aria-expanded="true">
              <p  id="currentFloor">Select Floor</p>
              <span class="caret"></span>
            </button>
            <ul id="floorContainer" class="dropdown-menu" aria-labelledby="dropdownMenu1">

            </ul>
          </div>

        </div>
      </div>-->
      <div class="row">
      <!--***Place Tab HTML Here***-->

<!--
<ul id="floorContainer" class="dropdown-menu" aria-labelledby="dropdownMenu1">
<li id="floorListTemplate" class="">
<a class="floorName" href="#">Exterior</a>
</li><li id="floorListTemplate" class="">
<a class="floorName" href="#">SecondFloor</a>
</li><li id="floorListTemplate" class="">
<a class="floorName" href="#">FirstFloor</a>
</li><li id="floorListTemplate" class="">
<a class="floorName" href="#">BasementOne</a>
</li><li id="floorListTemplate" class="">
<a class="floorName" href="#">BasementTwo</a>
</li>
</ul>
-->

        <div class="tab points" style="">
			<div class="selectdiv ">
			  <label>
				  <select class="menu-buildings">
					  <option value="">:: Select Building ::</option>
				  </select>
			  </label>
			</div>


        	<input type="text" class="filter" placeholder="">
        	<button><i class="fa fa-search"></i></button>
        	<br clear="all">
        	<div class="contain-list">
				<ul class="list-group"></ul>
			</div>
		</div>

      </div>
    </div>
    <li id="floorListTemplate" class="invisible">
      <a class="floorName" href="#">First Floor</a>
    </li>

    <!--<div id="controls-section" style="pointer-events: auto">
      <ul>
        <li class="" onclick="zoomInHandler()">
          <span class="controls-btn ctrl-zoom-in glyphicon glyphicon-plus" aria-hidden="true"></span>
        </li>
        <li class="">
          <i id="rotate_left" class="material-icons controls-btn ctrl-rotate-left" onclick="rotateLeft()" aria-hidden="true">rotate_left</i>
          <i id="rotate_right" class="material-icons controls-btn ctrl-rotate-right" onclick="rotateRight()" aria-hidden="true">rotate_right</i>
        </li>
        <li class="">
          <span class=" controls-btn ctrl-zoom-out glyphicon glyphicon-minus" onclick="zoomOutHandler()" aria-hidden="true"></span>
        </li>
      </ul>
    </div>-->

  </div>

  <iframe src="./map.php" id="ambiarcIframe" style="width:100%; height:100%; border:none; top:
    0; z-index:-1; position:fixed; pointer-events: auto;">
    Your browser doesn't support iframes
  </iframe>

  <div class="nav-menu menu-open">menu</div>

  <div class="nav-menu cat-wrap fade-out">
	<div class="menu-category" style="background-color:#dde2e2"><span class="cat-box" data-type="buildings">buildings</span></div>
	<div class="menu-category" style="background-color:#d6cecd"><span class="cat-box" data-type="academics">academics</span></div>
	<div class="menu-category" style="background-color:#9a8e88"><span class="cat-box" data-type="offices">offices</span></div>
	<div class="menu-category" style="background-color:#52869f"><span class="cat-box" data-type="facilities">facilities</span></div>
	<div class="menu-category" style="background-color:#f4581e"><span class="cat-box">accessibility</span></div>
	<div class="menu-category" style="background-color:#fff"><span class="cat-box cat-box-search"><img class="search-btn" src="images/view.png"></span></div>
  </div>

	<div class="flyout buildings"></div>
	<div class="flyout academics"></div>
	<div class="flyout offices"></div>
	<div class="flyout facilities"></div>



	<div class="mapouter map-bfda map-flsh ">
		<iframe width="" height="" frameborder="0" src="" scrolling="no"></iframe>
	</div>

	<div class="mapouter map-crr ">
		<iframe width="" height="" frameborder="0" src="" scrolling="no"></iframe>
	</div>

	<img class="pratt-logo" src="images/Pratt_Logo_Black.png">

</body>

</html>
