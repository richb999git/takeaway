// show file name when upload file chosen
function uploadFile(target) {
    document.getElementById("fileName").innerHTML = target.files[0].name;
}
