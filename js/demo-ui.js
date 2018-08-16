 var mainBldgID;
 var isFloorSelectorEnabled = false;
 var floors = {};
 var currentFloorId;
 var MapLabels = {};

 //User clicked the floor selector
 var dropdownClicked = function() {
   //Take action based on the current state of the floor selector
   if (!isFloorSelectorEnabled) {
     $("#levels-dropdown").addClass('open');
     $("#levels-dropdown-button").attr('aria-expanded', true);
     isFloorSelectorEnabled = true;
   } else {
     $("#levels-dropdown").removeClass('open');
     $("#levels-dropdown-button").attr('aria-expanded', false);
     isFloorSelectorEnabled = false;
     $("#currentFloor").text("Exterior");
   }
   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   //alert(mainBldgID);
   ambiarc.viewFloorSelector(mainBldgID);
 };

 //Handler for when the map is ready. This method creates the floor selector and subscribes to events.
 var InternalOnAmbiarcLoaded = function() {
   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   ambiarc.registerForEvent(ambiarc.eventLabel.RightMouseDown, onRightMouseDown);
   ambiarc.registerForEvent(ambiarc.eventLabel.FloorSelected, onFloorSelected);
   ambiarc.registerForEvent(ambiarc.eventLabel.FloorSelectorEnabled, onEnteredFloorSelector);
   ambiarc.registerForEvent(ambiarc.eventLabel.FloorSelectorDisabled, onExitedFloorSelector);
   ambiarc.registerForEvent(ambiarc.eventLabel.FloorSelectorFloorFocusChanged, onFloorSelectorFocusChanged);
   ambiarc.registerForEvent(ambiarc.eventLabel.CameraMotionCompleted, cameraCompletedHandler);

   ambiarc.getAllBuildings((bldgs) => {
     mainBldgID = bldgs[0];
     ambiarc.getAllFloors(mainBldgID, (local_floors) => {
       addFloorToFloor(null, mainBldgID, "Exterior");
       local_floors.sort(function(a, b) {
         return b.positionIndex - a.positionIndex;
       });
       for (f in local_floors) {
         floors[local_floors[f].id] = local_floors[f].positionName;
         addFloorToFloor(local_floors[f].id, mainBldgID, local_floors[f].positionName);
       }
       $('#bootstrap').removeAttr('hidden');
     });
   });
 }
 //Event callback handlers
 var onRightMouseDown = function(event) {

   //console.log("Ambiarc received a RightMouseDown event");
 }

 var onFloorSelected = function(event) {
   var floorInfo = event.detail;
   currentFloorId = floorInfo.floorId;
   $("#currentFloor").text(floors[floorInfo.floorId])
   if (isFloorSelectorEnabled) {
     $("#levels-dropdown").removeClass('open');
     $("#levels-dropdown-button").attr('aria-expanded', false);
     isFloorSelectorEnabled = false;
   }
   console.log("Ambiarc received a FloorSelected event with a buildingId of " + floorInfo.buildingId + " and a floorId of " + floorInfo.floorId);
 }

 var onEnteredFloorSelector = function(event) {
   var buildingId = event.detail;
   currentFloorId = undefined;
   if (!isFloorSelectorEnabled) {
     isFloorSelectorEnabled = true;
     $("#levels-dropdown").addClass('open');
     $("#levels-dropdown-button").attr('aria-expanded', true);
   }
   console.log("Ambiarc received a FloorSelectorEnabled event with a building of " + buildingId);
 }

 var onExitedFloorSelector = function(event) {
   var buildingId = event.detail;
   currentFloorId = undefined;
   if (isFloorSelectorEnabled) {
     $("#levels-dropdown").removeClass('open');
     $("#levels-dropdown-button").attr('aria-expanded', false);
     isFloorSelectorEnabled = false;
   }
   console.log("Ambiarc received a FloorSelectorEnabled event with a building of " + buildingId);
 }

 var onFloorSelectorFocusChanged = function(event) {
   console.log("Ambiarc received a FloorSelectorFocusChanged event with a building id of: " + event.detail.buildingId +
     " and a new floorId of " + event.detail.newFloorId + " coming from a floor with the id of " + event.detail.oldFloorId);
 }

 var firstFloorSelected = function(pId) {
   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   ambiarc.focusOnFloor(mainBldgID, 'L002');
 };

 var secondFloorSelected = function(pId) {
   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   ambiarc.focusOnFloor(mainBldgID, 'L003');
 };

 //Creates a list item with floor information
 var addFloorToFloor = function(fID, bID, name) {
   var item = $("#floorListTemplate").clone().removeClass("invisible").appendTo($("#floorContainer"));
   item.children("a.floorName").text("" + name).on("click", function() {
     var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
     console.log($("#currentFloor"));
     if (fID != undefined) {
       ambiarc.focusOnFloor(bID, fID);
       $("#currentFloor").text(name);
     } else {
       ambiarc.viewFloorSelector(bID);
       $("#currentFloor").text(name);
     }
   });
 };

 //Rotate handlers
 var rotateLeft = function() {
   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   ambiarc.rotateCamera(-45, 0.2);
   $('#rotate_left').removeAttr('onclick');
   setTimeout(function() {
     $('#rotate_left').attr('onclick', 'rotateLeft(this);');
   }, 500);
 };
 var rotateRight = function() {
   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   ambiarc.rotateCamera(45, 0.2);
   $('#rotate_right').removeAttr('onclick');
   setTimeout(function() {
     $('#rotate_right').attr('onclick', 'rotateRight(this);');
   }, 500);
 };

 var zoomOutHandler = function() {
   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   ambiarc.zoomCamera(-0.2, 0.3);

 };
 var zoomInHandler = function() {

   var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
   ambiarc.zoomCamera(0.2, 0.3);
 };

 /// added functions /////////////////////////////////////////////////////////////////////

 var cameraCompletedHandler = function(event){

    console.log("camera completed handler!");
    console.log(event);

    try{
		var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;
		setTimeout(function(){
			for(var item in mapStuff) {
				var id = mapStuff[item].user_properties.recordId;
				ambiarc.hideMapLabel(id, true);
			}
		}, 125);
	} catch(err) {
		console.log(err);
	}

	//     if(currentFloorId == null){
	//         $('#bldg-floor-select').val('Exterior');
	//     }
	//     else {
	//         $('#bldg-floor-select').val(currentBuildingId+'::'+currentFloorId);
	//     }
	//
	//     if(event.detail == -1) {
	//         return;
	//     }
	//
	//     // listening for exterior camera movement
	//     if(event.detail == 1000){
	//         ambiarc.focusOnFloor(mainBldgID, null, 300);
	//         currentFloorId = null;
	//         $('#bldg-floor-select').val('Exterior');
	//         visibilityHandler();
	//         return;
	//     }
	//
	//     //listening for focusing on exterior point camera movement
	//     else if(event.detail == 100){
	//         $('#bldg-floor-select').val('Exterior');
	//         showPoiDetails();
	//         visibilityHandler();
	//     }
	//
	//     //focus on maplabel completed!!
	//     else if(event.detail == 200){
	//         showPoiDetails();
	//         visibilityHandler();
	//     }

};

var destroyAllLabels = function(){

	var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;

	$.each(ambiarc.poiList, function(MapLabelID, a){
		ambiarc.destroyMapLabel(parseInt(MapLabelID));
	});

	ambiarc.poiList = {};
	poisInScene = [];
	colorsInScene = {
		'Wall' : '#01abba',
		'Room' : '#01abba',
		'Restroom' : '#01abba',
		'Walkway' : '#01abba',
		'Stairs' : '#01abba',
		'Elevator' : '#01abba',
		'Escalator' : '#01abba',
		'Ramp' : '#01abba',
		'Non-Public' : '#01abba'
	};

	updatePoiList();
	showPoiList();
};

var hideInactivePoints = function(immediate=true, currentLabelId) {

	var ambiarc = $("#ambiarcIframe")[0].contentWindow.Ambiarc;

	if(!immediate) {
		var immediate = false;
	}

	// 	console.log('one');
	// 	console.log(ambiarc.poiList);
	// 	console.log('two');
	//
	// 	ambiarc.poiList = mapStuff;
	//
	// 	console.log('three');
	// 	console.log(ambiarc.poiList);
	// 	console.log('four');
	//
	// 	$.each(ambiarc.poiList, function(id, obj){
	//         if(id != currentLabelId) {
	//             ambiarc.hideMapLabel(id, immediate);
	//         } else {
	//             if(obj.floorId == currentFloorId){
	//                 ambiarc.showMapLabel(id, immediate)
	//             }
	//         }
	// 	});
	//
	//     if(ambiarc.poiList[currentLabelId].floorId !== currentFloorId){
	//         ambiarc.hideMapLabel(currentLabelId);
	//     } else {
	//         ambiarc.showMapLabel(currentLabelId);
	//     }

	$.each(mapStuff, function(id, obj){
        if(id != currentLabelId) {

        	//console.log('hide this label');
        	//console.log(mapStuff[id]);

            ambiarc.hideMapLabel(id, immediate);
        } else {
            if(obj.floorId == currentFloorId){
                ambiarc.showMapLabel(id, immediate)
            }
        }
	});

};

