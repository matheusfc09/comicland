var search_box = function(root_path) {
	$("#search_box").tokenInput(root_path + "system/search.php", {
		theme: 'facebook',
		tokenLimit: 1,
		resultsFormatter: function(item) {
			if(item.type == "name")
				return "<li><b>" + item.name + "</b><br><i>Character</i></li>"
			else if(item.type == "series")
				return "<li><b>" + item.name + "</b><br><i>Series of Comics</i></li>"
			else if(item.type == "title")
				return "<li><b>" + item.name + "</b><br><i>Title of Comics</i></li>"
		},
		onAdd: function(item) {
			if(item.type == "name")
				window.location.href = root_path + "character.php?id=" + item.id;
			else
				window.location.href = root_path + "comic.php?id=" + item.id;
		}
	});
	
	$("#search_form .token-input-list-facebook input").attr("placeholder", "Search");
	
	$("#search_form .token-input-list-facebook input").focusin(function(){
		$("#search_form .token-input-list-facebook").addClass("token-input-list-facebook_focused");
	});
	$("#search_form .token-input-list-facebook input").focusout(function(){
		$("#search_form .token-input-list-facebook").removeClass("token-input-list-facebook_focused");
	});

};