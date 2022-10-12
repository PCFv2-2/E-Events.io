function setDropdown(){
    if (document.querySelector('.dropdown').style.display == "inline-block"){
        document.querySelector('.dropdown').style.display = "none";
    } else {
        console.log('block');
        document.querySelector('.dropdown').style.display = "inline-block";
    }
}