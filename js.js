function toggleForm() {
	let el = document.getElementById("myForm");
	if (el.style.display == "none")
    	el.style.display = "block";
    else
    	el.style.display = "none";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
