/*
$(document).ready(function(){
	$(".articleBox img").fadeTo("fast", 1); // This sets the opacity of the thumbs to fade down to 60% when the page loads
	$(".articleBox img").hover(function(){
		$(this).fadeTo("fast", 1); // This should set the opacity to 100% on hover
	},function(){
		$(this).fadeTo("fast", 1); // This should set the opacity back to 60% on mouseout
	});
});*/

if (location.host == "localhost") {
	devserv = "/work/publion";
} else {
	devserv = "";
}

function AddArticleToFav(artId) {
	$.ajax({
		type: "GET",
		url: "http://" + location.host + devserv + "/favs/addarticletofav/" + artId,
		//async : false,
		data: "",
		success: function (resp) {
			//alert('Adaugat cu succes!');
			$.prompt('Adaugat cu succes la anunturi Favorite.');
		}
	});
}

function AddToFriends(artId) {
	$.ajax({
		type: "GET",
		url: "http://" + location.host + devserv + "/friends/addtofriends/" + artId,
		//async : false,
		data: "",
		success: function (resp) {
			//alert('Adaugat cu succes!');
			$.prompt('Adaugat cu succes la prieteni.');
		}
	});
}
		