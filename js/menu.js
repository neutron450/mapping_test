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

		var schoolString = '';
		$(document.aca.academics).each(function(key, record){
			window.schoolList = Object.keys(record);
		});

		var subFly;
		$(schoolList).each(function(key0, level0){
			schoolString += '<span class="fly-box" data-school="'+level0+'" >'+level0+'</span>';
			subFly = '<div class="subfly" data-type="'+level0+'" >';
			$(document.aca.academics[level0]).each(function(key1, level1){
				for(var item in level1) {
					subFly += '<span data-bldg="'+level1[item][0]+'" data-dept="'+item+'">'+item+'</span>';
				}
			});
			subFly += '</div>';
			$('body').append(subFly);
		});

		$('div.schools').append(schoolString);

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

	$(document).on("click", "div.subfly>span", function(e){
		var bldg = $(this).attr('data-bldg');
		var dept = $(this).attr('data-dept');
		var schl = $(this).closest('div').attr('data-type');
		//alert(bldg + ' - ' + dept + ' - ' + schl);

		if (dept == '') {

		}

		console.log(' - - - - - - - - - - - ');
		for(var item in mapStuff) {
			//if (mapStuff[item].user_properties.bldgAbbr == bldg && mapStuff[item].user_properties.gkDepartment == dept) {
			if (mapStuff[item].user_properties.bldgAbbr == bldg) {
				if (mapStuff[item].user_properties.gkDepartment.indexOf(dept) != -1) {
					console.log(mapStuff[item]);
					var id = mapStuff[item].properties.mapLabelId;
					adjustMapFocus(e.currentTarget, id);
					break;
				}
			}
		}
		console.log(' - - - - - - - - - - - ');


	});


