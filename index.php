<html>

<head>
  <title>Ambiarc</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" media="all" href="TemplateData/css/bootstrap.css" />
  <link rel="stylesheet" media="all" href="css/demo-ui.css" />
  <link rel="stylesheet" media="all" href="css/tab_style.css?nc=<?php echo time(); ?>" />
  <script src="TemplateData/js/jquery-2.2.4.min.js"></script>
  <script src="TemplateData/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <script src="js/demo-ui.js"></script>

  <script src="GettingStartedComplete.js?nc=<?php echo time(); ?>"></script>

  <style>


  </style>

</head>

<body style="pointer-events: none">
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
		//console.log(filter);
		//$(".list-group-item").not(":containsIgnoreCase('" + filter + "')").addClass("hidden");
		//$(".list-group-item:containsIgnoreCase('" + filter + "')").removeClass("hidden");
		$(".list-group-item").not(":containsi('" + filter + "')").addClass("hidden");
		$(".list-group-item:containsi('" + filter + "')").removeClass("hidden");

		var building = $("select.menu-buildings").val();

		if(building != "") {

			//alert(building);

			// 	if ($(".list-group-item").attr('data-building') != building) {
			// 		$(".list-group-item").addClass("hidden");
			// 	}

			$(".list-group-item[data-building!='"+building+"']").addClass("hidden");

		}

	}

	//$("#search").on("keyup", $.debounce(searchFunction, 300));
	//$(document).on("keyup", "input.filter", $.debounce(searchFunction, 300));

	</script>

</body>

</html>
