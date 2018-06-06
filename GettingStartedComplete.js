// Tells Ambiarc to focus on a map label id
function adjustMapFocus(target, mapLabelId) {
  // Declare all variables
  var i, tablinks;

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  if (target != undefined) target.className += " active";
  // Retrieve ambiarc object
  var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;

  //alert(mapLabelId);

  // call the focusOnMapLabel with the map label id
  ambiarc.focusOnMapLabel(mapLabelId);
}

//This method is called when the iframe loads, it subscribes onAmbiarcLoaded so we know when the map loads
var iframeLoaded = function() {
  $("#ambiarcIframe")[0].contentWindow.document.addEventListener('AmbiarcAppInitialized', function() {
    onAmbiarcLoaded();
  });
}

//Handler for when the map is ready. This method creates the floor selector and subscribes to events.
var onAmbiarcLoaded = function() {
  var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
  ambiarc.registerForEvent(ambiarc.eventLabel.MapLabelSelected, (event) => {
    adjustMapFocus($("#" + event.detail)[0], event.detail)
  });

	var hash = Math.random().toString(36).substr(2, 5);

  //load MapLabels from a preprovided map file
  var full = location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + (window.location.pathname ? window.location.pathname.substring(0, window.location.pathname.lastIndexOf("/")) : '');
  //ambiarc.loadRemoteMapLabels(full + "/tutorial_map_labels.json").then((out) => {});
  //ambiarc.loadRemoteMapLabels("http://facilities/facilities/fetch").then((out) => {
  ambiarc.loadRemoteMapLabels("https://map.pratt.edu/facilities/web/facilities/get?token="+document.token+"&webapp=display").then((out) => {
	MapLabels = out;
	//ambiarc.mapStuff = out;
	//console.log(ambiarc.mapStuff);
	buildMapMenu(out);
  });

  InternalOnAmbiarcLoaded();
}


function buildMapMenu(MapLabels){
	lButtons = {};
	lBldgs = {};
	$(MapLabels).each(function(key, record){
		lBldgs[record.user_properties.bldgAbbr] = record.user_properties.bldgName;
		lButtons[record.properties.mapLabelId] = '<li  id="'+record.properties.mapLabelId+'"  data-id="'+record.properties.mapLabelId+'"  data-building="'+record.user_properties.bldgAbbr+'"  class="list-group-item"  >';
		lButtons[record.properties.mapLabelId] += '<div class="li-col li-label"><span>'+record.properties.label+'</span></div>';
		lButtons[record.properties.mapLabelId] += '<div class="li-col li-bldg"><span>'+record.user_properties.bldgAbbr+'</span></div>';
		lButtons[record.properties.mapLabelId] += '<div class="li-col li-room"><span>'+record.user_properties.newRoomNo+'</span></div></li>';
	});
	joined = $.map(lButtons, function(e){
		return e;
	}).join(' ');
	$('ul.list-group').append(joined);
	//console.log(lBldgs);
	bOptions = {};
	for (var prop in lBldgs) {
		bOptions[prop] = '<option value="'+prop+'">'+lBldgs[prop]+'</option>';
	}
	joined = $.map(bOptions, function(e){
		return e;
	}).join(' ');
	$('select.menu-buildings').append(joined);
}













