

function zile_luna(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("nastere").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("nastere").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "data.php?q="+str, true);
  xhttp.send();
}