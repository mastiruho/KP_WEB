//функция, которая добавляет textaria и input 
function insert(index)
{
	let addImg = document.getElementById("addImg");
	let button = document.getElementById("button_submit");
	let br = document.createElement("br");
	let br2 = document.createElement("br");
	let image_field = document.createElement("input");
	let text_field = document.createElement("textarea");
	let form = document.getElementById("form_id");
	addImg.setAttribute("onclick", "insert("+(index+1)+")");
	text_field.setAttribute("name", "text[]");
	text_field.setAttribute("id", "editor" + index);
	image_field.setAttribute("type", "file");
	image_field.setAttribute("name", "images[]");
	image_field.setAttribute("accept", "image/jpeg");
	image_field.setAttribute("class", "image_file");
	form.insertBefore(image_field, button);
	form.insertBefore(br, button);
	form.insertBefore(text_field, button);
	form.insertBefore(br2, button);
	CKEDITOR.replace('editor'+index);
}
