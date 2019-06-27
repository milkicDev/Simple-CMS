function remove(id) {
    if (id.length == 0) { 
        document.getElementById("message").innerHTML = "";
        return;
    } else {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("message").innerHTML = "Article ID "+ id +" has been removed from the database!";
			}
		};
        xmlhttp.open("POST", "./api.php?action=remove&tb=articles&id=" + id, true);
        xmlhttp.send();
    }
}