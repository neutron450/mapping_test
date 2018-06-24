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
		$(".list-group-item").not(":containsi('" + filter + "')").addClass("hidden");
		$(".list-group-item:containsi('" + filter + "')").removeClass("hidden");
		var building = $("select.menu-buildings").val();
		if(building != "") {
			$(".list-group-item[data-building!='"+building+"']").addClass("hidden");
		}
	}

