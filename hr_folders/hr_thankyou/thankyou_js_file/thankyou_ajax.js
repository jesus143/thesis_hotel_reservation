// alert("reservation ajax")


function  delete_reservation ( ) {
	var bol = confirm("are you sure to delete the reservation ? "); 
	if (bol == true) {
		alert("reservation succesfully deleted!")
		document.location = 'home';
	}else{
		alert("reservatoin not deleted! ")
	}
}