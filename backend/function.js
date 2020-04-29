function check_of_consent() {
    var checkBox = document.getElementById("myCheck");
    var btn = document.getElementById("submitbtn");
    if (checkBox.checked == true){
        btn.style.display = "block";
    }
    else {
        btn.style.display = "none";
    }
}