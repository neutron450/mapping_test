// Tells Ambiarc to focus on a map label id
function adjustMapFocus(target, mapLabelId) {
  // Declare all variables
  var i, tablinks;

  // Get all elements with class="tablinks" and remove the class "active"
	//   tablinks = document.getElementsByClassName("tablinks");
	//   for (i = 0; i < tablinks.length; i++) {
	//     tablinks[i].className = tablinks[i].className.replace(" active", "");
	//   }

  // Show the current tab, and add an "active" class to the button that opened the tab
  ///if (target != undefined) target.className += " active";
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

  //load MapLabels from a preprovided map file
  var full = location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + (window.location.pathname ? window.location.pathname.substring(0, window.location.pathname.lastIndexOf("/")) : '');
  var hash = Math.random().toString(36).substr(2, 5);
  //var options = { method: 'post', headers: new Headers({ 'Authorization': 'Basic '+btoa('user:pass'), 'Content-Type': 'application/x-www-form-urlencoded' }), };
  //ambiarc.loadRemoteMapLabels(full + "/tutorial_map_labels.json").then((out) => {});
  //ambiarc.loadRemoteMapLabels("http://facilities/facilities/fetch").then((out) => {
  //ambiarc.loadRemoteMapLabels(full + '/points3.json').then((out) => {
  ambiarc.loadRemoteMapLabels("https://map.pratt.edu/facilities/web/facilities/get?hash="+hash+"&token="+document.token+"&webapp=display").then((out) => {
  //ambiarc.loadRemoteMapLabels("https://map.pratt.edu/facilities/web/facilities/get?token=65b22c76497f3b4c4436bf324e6154").then((out) => {
  //ambiarc.loadRemoteMapLabels("http://facilities.local/facilities/get?token=65b22c76497f3b4c4436bf324e6154").then((out) => {

	MapLabels = out;
	window.mapStuff = out;

	setupMenuBuildings(out);
	setupMenuAcademics();
	setupMenuOffices();

  });

  InternalOnAmbiarcLoaded();
}
















