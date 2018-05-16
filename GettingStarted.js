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

  /**Ambiarc Specific Code**/

}

//This method is called when the iframe loads, it subscribes onAmbiarcLoaded so we know when the map loads
var iframeLoaded = function() {
    /**Ambiarc Specific Code**/
  $("#ambiarcIframe")[0].contentWindow.document.addEventListener('AmbiarcAppInitialized', function() {
    onAmbiarcLoaded();
  });
}

//Handler for when the map is ready. This method creates the floor selector and subscribes to events.
var onAmbiarcLoaded = function() {
  /**Ambiarc Specific Code**/

  InternalOnAmbiarcLoaded();
}
