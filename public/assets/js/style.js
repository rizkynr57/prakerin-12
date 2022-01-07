document.querySelector('.delete-btn').addEventListener('click', function() {
	document.querySelector('.container').classList.add('.active'),
	document.getElementById("delete").style.zIndex = "-1";
});

function closeCont() {
	document.querySelector('.container').classList.remove('active'),
	document.getElementById("delete").style.zIndex = " 1";
}
