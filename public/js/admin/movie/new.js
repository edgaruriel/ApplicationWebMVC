window.onload = function() {
    document.getElementById("newBtn").onclick = function(){return validation()};
    document.getElementById("totalUnits").onkeypress= function(){return justNumbers(event)};
    document.getElementById("price").onkeypress= function(){return justNumbers(event)};
}

function validation(){
	var title = document.getElementById("title").value;
	var format = document.getElementById("format").value;
	var totalUnits = document.getElementById("totalUnits").value;
	var year = document.getElementById("year").value;
	var price = document.getElementById("price").value;
	var code = document.getElementById("code").value;
	var gender = document.getElementById("gender").value;
	var photo = document.getElementById("file_img").value;
	
	if(title == "" || format=="" || totalUnits=="" || year=="" || price=="" || code=="" || gender=="" || photo==""){
		alert("Todos los campos son obligatorios");
		return false;
	}else{
		return true;
	}
}

function justNumbers(e)
{
	var keynum = window.event ? window.event.keyCode : e.which;
	if ((keynum == 8) || (keynum == 46))
	return true;
	 
	return /\d/.test(String.fromCharCode(keynum));
}