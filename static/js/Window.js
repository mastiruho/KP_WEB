function confirmWindow(FOLDER_NAME, id){
	let agreement = confirm("Вы уверены, что хотите удалить статью?");
	if (agreement){
		window.location.href = "/"+FOLDER_NAME+"article/delete/"+id+"/";
	}
}

function confirmWindow2(FOLDER_NAME){
	let agreement = confirm("Вы уверены, что хотите выйти с сайта?");
	if (agreement){
		window.location.href = "/"+FOLDER_NAME+"users/logout/";
	}
}
	