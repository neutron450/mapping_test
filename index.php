<?php

	//ini_set('error_reporting', E_ERROR & ~E_WARNING);
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', true);
	ini_set('log_errors', 1);
	ini_set('error_log', 'php-error.log');
	error_log( ' - - - - - - - - - - - - - - - - ' );

	session_start();
	//echo __DIR__;
	include_once('includes/dbtools.inc.php');
	$obj = new DbTools;
	if (!$_SESSION['token']) {
		$obj->createToken();
	} else {
		if ($obj->checkToken($_SESSION['token'])) {
			//is okay
		} else {
			echo 'no token';
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

  <script src="TemplateData/js/jquery-2.2.4.min.js"></script>
  <script src="TemplateData/js/bootstrap.min.js"></script>
  <script src="js/menu.js?nc=<?php echo time(); ?>"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script>
    	document.token = "<?php echo $_SESSION['token'] ?>";
    	var aca = '<?php $obj->fetchAcademicArray() ?>';
    	document.aca = JSON.parse(aca);
    </script>

  <script src="js/demo-ui.js"></script>

  <script src="GettingStartedComplete.js?nc=<?php echo time(); ?>"></script>

  <style>


  </style>

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
        	<!--<div class="filter" contenteditable="true">filter</div>-->

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

    <div id="controls-section" style="pointer-events: all">
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
    </div>
  </div>

  <iframe src="./map.html" id="ambiarcIframe" style="width:100%; height:100%; border:none; top:
    0; z-index:-1; position:fixed; pointer-events: all;">
    Your browser doesn't support iframes
  </iframe>

  <div class="nav-menu menu-open">menu</div>

  <div class="nav-menu cat-wrap fade-out">
	<div class="menu-category" style="background-color:#dde2e2"><span class="cat-box" data-type="buildings">buildings</span></div>
	<div class="menu-category" style="background-color:#d6cecd"><span class="cat-box" data-type="schools">academics</span></div>
	<div class="menu-category" style="background-color:#9a8e88"><span class="cat-box">offices</span></div>
	<div class="menu-category" style="background-color:#52869f"><span class="cat-box">facilities</span></div>
	<div class="menu-category" style="background-color:#f4581e"><span class="cat-box">accessibility</span></div>
  </div>

  <div class="flyout buildings"></div>
  <div class="flyout schools"></div>

  <img class="search-btn" src="images/view.png">

	<script>

	$(document).on('click', '.search-btn', function() {
		$('.points').addClass('reveal-vert');
		$('.menu-open').addClass('fade-out');
		$('.reveal-horz').removeClass('reveal-horz');
		$('.search-btn').fadeOut();
	});

	$(document).on('click', '.menu-open', function() {
		$('.menu-open').addClass('fade-out');
		$('.cat-wrap').removeClass('fade-out');
		$('.search-btn').fadeOut();
		$('body').css({'pointer-events':'auto'});
		$('iframe').css({'pointer-events':'all'});
	});

	$(document).on('click', '.cat-box', function() {
		$('.reveal-horz').removeClass('reveal-horz');
		var pos = $(this).closest('div').position();
		var type = $(this).attr('data-type');
		$('div.'+type).css({left:pos.left});
		$('div.'+type).addClass('reveal-horz');
	});

	$(document).on('click', '.fly-box', function() {
		$('.subfly').removeClass('reveal-horz');
		var pos = $(this).closest('div').position();
		var wid = $(this).closest('div').width();
		var left = parseInt(pos.left + wid);
		//alert(wid + ' -- ' + left);
		var type = $(this).attr('data-school');
		$("[data-type='"+type+"']").css({left:left});
		$("[data-type='"+type+"']").addClass('reveal-horz');
	});

	$('div.flyout').mouseleave(function() {
		var close = true;
		if ($('.subfly').css('opacity') > 0) {
			close = false;
		}
		$('.subfly').each(function(){
			if ($(this).css('opacity') > 0) {
				close = false;
			}
		});
		if (close == true) {
			$(this).removeClass('reveal-horz');
		}
	});

	$('.subfly').mouseleave(function(e) {
		alert(e.target.nodeName);
		$('.subfly').removeClass('reveal-horz');
	});

	$(document).keyup(function(e) {
		if (e.keyCode === 27) {
			resetMenus();
		}
	});

	$(document).on('click', '*', function(e) {
		console.log(e.target.nodeName);
		if (e.target.nodeName=='BODY' || e.target.nodeName=='HTML') {
			resetMenus();
		}
	});

	function resetMenus() {
		$('.menu-open').removeClass('fade-out');
		$('.cat-wrap').addClass('fade-out');
		$('.reveal-horz').removeClass('reveal-horz');
		$('.reveal-vert').removeClass('reveal-vert');
		$('.search-btn').fadeIn();
		$('html').css({'pointer-events':'none'});
		$('body').css({'pointer-events':'none'});
		$('iframe').css({'pointer-events':'all'});
	}

	</script>

</body>

</html>
