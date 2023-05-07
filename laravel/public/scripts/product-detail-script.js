function changeImage(id) {
    if (id === 1) {
        document.getElementById("img-1").style.display = "block";
        document.getElementById("img-2").style.display = "none";
    } else {
        document.getElementById("img-1").style.display = "none";
        document.getElementById("img-2").style.display = "block";
    }
}
