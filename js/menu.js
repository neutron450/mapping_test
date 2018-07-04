
	$(document).ready(function(){

		$.extend($.expr[':'], {
		  'containsi': function(elem, i, match, array) {
			return (elem.textContent || elem.innerText || '').toLowerCase()
				.indexOf((match[3] || "").toLowerCase()) >= 0;
		  }
		});

		var schoolString = '';
		$(document.acad.academics).each(function(key, record){
			window.schoolList = Object.keys(record);
		});

		var subFly;
		$(schoolList).each(function(key0, level0){
			schoolString += '<span class="fly-box" data-school="'+level0+'" >'+level0+'</span>';
			subFly = '<div class="subfly" data-type="'+level0+'" >';
			$(document.acad.academics[level0]).each(function(key1, level1){
				for(var item in level1) {
					subFly += '<span data-bldg="'+level1[item][0]+'" data-dept="'+item+'">'+item+'</span>';
				}
			});
			subFly += '</div>';
			$('body').append(subFly);
		});

		$('div.schools').append(schoolString);

		$(document).on("click", "li.list-group-item", function(e){
			console.log(e);
			var id = $(this).attr('data-id');
			adjustMapFocus(e.currentTarget, id);
			//$('.active').removeClass('active');
			$(this).addClass('seen').siblings().removeClass('active');
		});

		$(document).on('click', '.search-btn', function() {
			$('.points').addClass('reveal-vert');
			$('.menu-open').addClass('fade-out');
			$('.reveal-horz').removeClass('reveal-horz');
			$('.search-btn').fadeOut();
			$('body').append('<div class="click-capture"></div>');
		});

		$(document).on('click', '.menu-open', function() {
			$('.menu-open').addClass('fade-out');
			$('.cat-wrap').removeClass('fade-out');
			$('.search-btn').fadeOut();
			//$('body').css({'pointer-events':'auto'});
			//$('*').css({'pointer-events':'auto'});
			//$('#gameContainer').css({'pointer-events':'auto'});
			$('body').append('<div class="click-capture"></div>');

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

		$(document).on('click', '.click-capture', function() {
			//collapseMenus();
			resetMenus();
		});


		$('.flyout').mouseleave(function() {
			var close = true;
			$('.subfly').each(function(){
				if ($(this).css('opacity') > 0) {
					close = false;
				}
			});
			if (close == true) {
				var hi = $(this).height();
				$('.flyout').css({height: hi});
				setTimeout(function(){
					$('.flyout').animate({width: '0px', opacity: 0}).promise().then(function(){
						$('.flyout').removeClass('reveal-horz').promise().then(function(){
							setTimeout(function(){ $('.flyout').removeAttr('style'); }, 750);
						});
					});
				}, 750);
			}
		});

		$('.subfly').mouseleave(function(e) {
			var hi = $(this).height();
			$('.subfly').css({height: hi});
			setTimeout(function(){
				$('.subfly').animate({width: '0px', opacity: 0}).promise().then(function(){
					$('.subfly').removeClass('reveal-horz').promise().then(function(){
						setTimeout(function(){ $('.subfly').removeAttr('style'); }, 750);
					});
				});
			}, 750);
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

		$(document).on("keyup", "input.filter", function(e){
			//alert(this.value);
			searchFunction();
		});

		$(document).on("change", "select.menu-buildings", function(e){
			//alert(this.value);
			searchFunction();
		});

		$(document).on("click", "div.subfly>span", function(e){
			var bldg = $(this).attr('data-bldg');
			var dept = $(this).attr('data-dept');
			var schl = $(this).closest('div').attr('data-type');
			//alert(bldg + ' - ' + dept + ' - ' + schl);

			if (dept == '') {

			}

			for(var item in mapStuff) {
				if (mapStuff[item].user_properties.gkDepartment == '') {
					continue;
				}
				if (mapStuff[item].user_properties.bldgAbbr == bldg) {
					console.log(dept + ' +++ ' + (mapStuff[item].user_properties.gkDepartment));
					if (mapStuff[item].user_properties.gkDepartment.indexOf(dept) != -1) {
						console.log(mapStuff[item]);
						var id = mapStuff[item].properties.mapLabelId;
						adjustMapFocus(e.currentTarget, id);
						collapseMenus();
						break;
					}
				}
			}
		});
	});

	function resetMenus() {
		$('.menu-open').removeClass('fade-out');
		$('.cat-wrap').addClass('fade-out');
		$('.reveal-horz').removeClass('reveal-horz');
		$('.reveal-vert').removeClass('reveal-vert');
		$('.search-btn').fadeIn();
		$('body').css({'pointer-events':'none'});
		$('.click-capture').remove();
	}

	function collapseMenus() {
		setTimeout(function(){
			$('.subfly').animate({width: '0px', opacity: 0}).promise().then(function(){
				$('.subfly').removeClass('reveal-horz').promise().then(function(){
					setTimeout(function(){ $('.subfly').removeAttr('style'); }, 750);
					$('.flyout').animate({width: '0px', opacity: 0}).promise().then(function(){
						setTimeout(function(){
							$('.flyout').removeAttr('style');
							$('.flyout').removeClass('reveal-horz');
						}, 750);
						$('.nav-menu').animate({width: '0px', opacity: 0}).promise().then(function(){
							setTimeout(function(){
								$('.nav-menu').removeAttr('style');
								$('.nav-menu').removeClass('reveal-horz');
								resetMenus();
							}, 750);
						});
					});
				});
			});
		}, 750);
	}

	function searchFunction () {
		var filter = $("input.filter").val();
		$(".list-group-item").not(":containsi('" + filter + "')").addClass("hidden");
		$(".list-group-item:containsi('" + filter + "')").removeClass("hidden");
		var building = $("select.menu-buildings").val();
		if(building != "") {
			$(".list-group-item[data-building!='"+building+"']").addClass("hidden");
		}
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
		catBuildings = {};
		for (var prop in lBldgs) {
			bOptions[prop] = '<option value="'+prop+'">'+lBldgs[prop]+'</option>';
			catBuildings[prop] = '<span>'+lBldgs[prop]+'</span>';
		}
		joined = $.map(bOptions, function(e){
			return e;
		}).join(' ');
		$('select.menu-buildings').append(joined);
		joined = $.map(catBuildings, function(e){
			return e;
		}).join('');
		$('div.buildings').append(joined);
	}



