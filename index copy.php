<?php
	session_start();
	//echo __DIR__;
	include_once('dbtools.inc.php');
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
  <link rel="stylesheet" media="all" href="TemplateData/js/bootstrap-submenu-3.0.0/css/bootstrap-submenu.css" />

  <script src="TemplateData/js/jquery-2.2.4.min.js"></script>
  <script src="TemplateData/js/bootstrap.min.js"></script>
  <script src="TemplateData/js/bootstrap-submenu-3.0.0/js/bootstrap-submenu.js"></script>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script>
    	document.token = "<?php echo $_SESSION['token'] ?>";
    </script>

  <script src="js/demo-ui.js"></script>

  <script src="GettingStartedComplete.js?nc=<?php echo time(); ?>"></script>

  <style>


  </style>

</head>

<body style="pointer-events: none">
  <div id="bootstrap" hidden>
    <div class="container-fluid" style="z-index:100;">
      <div class="row">
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
      </div>
      <div class="row">
      <!--***Place Tab HTML Here***-->


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








<nav class="navbar navbar-light bg-light navbar-expand-sm">
  <a class="navbar-brand">Navbar</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" tabindex="0" data-toggle="dropdown" data-submenu="">
          Dropdown
        </a>

        <div class="dropdown-menu">
          <div class="dropdown dropright dropdown-submenu">
  <button class="dropdown-item dropdown-toggle" type="button" data-toggle="dropdown">Action</button>

  <div class="dropdown-menu">
    <button class="dropdown-item" type="button">Sub action</button>

    <div class="dropdown dropright dropdown-submenu">
      <button class="dropdown-item dropdown-toggle" type="button">Another sub action</button>

      <div class="dropdown-menu">
        <button class="dropdown-item" type="button">Sub action</button>
        <button class="dropdown-item" type="button">Another sub action</button>
        <button class="dropdown-item" type="button">Something else here</button>
      </div>
    </div>

    <button class="dropdown-item" type="button">Something else here</button>
    <button class="dropdown-item" type="button" disabled="">Disabled action</button>

    <div class="dropdown dropright dropdown-submenu">
      <button class="dropdown-item dropdown-toggle" type="button">Another action</button>

      <div class="dropdown-menu">
        <button class="dropdown-item" type="button">Sub action</button>
        <button class="dropdown-item" type="button">Another sub action</button>
        <button class="dropdown-item" type="button">Something else here</button>
      </div>
    </div>
  </div>
</div>

<div class="dropdown-header">Dropdown header</div>

<div class="dropdown dropright dropdown-submenu">
  <button class="dropdown-item dropdown-toggle" type="button">Another action</button>

  <div class="dropdown-menu">
    <button class="dropdown-item" type="button">Sub action</button>
    <button class="dropdown-item" type="button">Another sub action</button>
    <button class="dropdown-item" type="button">Something else here</button>
  </div>
</div>

<button class="dropdown-item" type="button">Something else here</button>
<div class="dropdown-divider"></div>
<button class="dropdown-item" type="button">Separated link</button>

        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" tabindex="0" data-toggle="dropdown" data-submenu="">
          Dropdown 2
        </a>

        <div class="dropdown-menu">
          <div class="dropdown dropright dropdown-submenu">
  <button class="dropdown-item dropdown-toggle" type="button" data-toggle="dropdown">Action</button>

  <div class="dropdown-menu">
    <button class="dropdown-item" type="button">Sub action</button>

    <div class="dropdown dropright dropdown-submenu">
      <button class="dropdown-item dropdown-toggle" type="button">Another sub action</button>

      <div class="dropdown-menu">
        <button class="dropdown-item" type="button">Sub action</button>
        <button class="dropdown-item" type="button">Another sub action</button>
        <button class="dropdown-item" type="button">Something else here</button>
      </div>
    </div>

    <button class="dropdown-item" type="button">Something else here</button>
    <button class="dropdown-item" type="button" disabled="">Disabled action</button>

    <div class="dropdown dropright dropdown-submenu">
      <button class="dropdown-item dropdown-toggle" type="button">Another action</button>

      <div class="dropdown-menu">
        <button class="dropdown-item" type="button">Sub action</button>
        <button class="dropdown-item" type="button">Another sub action</button>
        <button class="dropdown-item" type="button">Something else here</button>
      </div>
    </div>
  </div>
</div>

<div class="dropdown-header">Dropdown header</div>

<div class="dropdown dropright dropdown-submenu">
  <button class="dropdown-item dropdown-toggle" type="button">Another action</button>

  <div class="dropdown-menu">
    <button class="dropdown-item" type="button">Sub action</button>
    <button class="dropdown-item" type="button">Another sub action</button>
    <button class="dropdown-item" type="button">Something else here</button>
  </div>
</div>

<button class="dropdown-item" type="button">Something else here</button>
<div class="dropdown-divider"></div>
<button class="dropdown-item" type="button">Separated link</button>

        </div>
      </li>
    </ul>

    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" tabindex="0" data-toggle="dropdown" data-submenu="">
          Dropdown 3
        </a>

        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown dropleft dropdown-submenu">
  <button class="dropdown-item dropdown-toggle" type="button" data-toggle="dropdown">Action</button>

  <div class="dropdown-menu">
    <button class="dropdown-item" type="button">Sub action</button>

    <div class="dropdown dropleft dropdown-submenu">
      <button class="dropdown-item dropdown-toggle" type="button">Another sub action</button>

      <div class="dropdown-menu">
        <button class="dropdown-item" type="button">Sub action</button>
        <button class="dropdown-item" type="button">Another sub action</button>
        <button class="dropdown-item" type="button">Something else here</button>
      </div>
    </div>

    <button class="dropdown-item" type="button">Something else here</button>
    <button class="dropdown-item" type="button" disabled="">Disabled action</button>

    <div class="dropdown dropleft dropdown-submenu">
      <button class="dropdown-item dropdown-toggle" type="button">Another action</button>

      <div class="dropdown-menu">
        <button class="dropdown-item" type="button">Sub action</button>
        <button class="dropdown-item" type="button">Another sub action</button>
        <button class="dropdown-item" type="button">Something else here</button>
      </div>
    </div>
  </div>
</div>

<div class="dropdown-header">Dropdown header</div>

<div class="dropdown dropleft dropdown-submenu">
  <button class="dropdown-item dropdown-toggle" type="button">Another action</button>

  <div class="dropdown-menu">
    <button class="dropdown-item" type="button">Sub action</button>
    <button class="dropdown-item" type="button">Another sub action</button>
    <button class="dropdown-item" type="button">Something else here</button>
  </div>
</div>

<button class="dropdown-item" type="button">Something else here</button>
<div class="dropdown-divider"></div>
<button class="dropdown-item" type="button">Separated link</button>

        </div>
      </li>
    </ul>
  </div>
</nav>









        <div class="tab points" style="pointer-events: all">
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

	<script>

	$(document).on("click", "li.list-group-item", function(e){
		console.log(e);
		var id = $(this).attr('data-id');
		adjustMapFocus(e.currentTarget, id);
		//$('.active').removeClass('active');
		$(this).addClass('seen').siblings().removeClass('active');
	});

	$(document).ready(function(){
		$.extend($.expr[':'], {
		  'containsi': function(elem, i, match, array) {
			return (elem.textContent || elem.innerText || '').toLowerCase()
				.indexOf((match[3] || "").toLowerCase()) >= 0;
		  }
		});


		$('[data-submenu]').submenupicker();

	});

	$(document).on("keyup", "input.filter", function(e){
		//alert(this.value);
		searchFunction();
	});

	$(document).on("change", "select.menu-buildings", function(e){
		//alert(this.value);
		searchFunction();
	});

	function searchFunction () {
		var filter = $("input.filter").val();
		$(".list-group-item").not(":containsi('" + filter + "')").addClass("hidden");
		$(".list-group-item:containsi('" + filter + "')").removeClass("hidden");
		var building = $("select.menu-buildings").val();
		if(building != "") {
			$(".list-group-item[data-building!='"+building+"']").addClass("hidden");
		}
	}

	</script>

</body>

</html>
