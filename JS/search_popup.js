var SearchFilter = document.getElementById("mySearchFilter");

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  SearchFilter.style.display = "block";
}

span.onclick = function() {
  SearchFilter.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == SearchFilter) {
    SearchFilter.style.display = "none";
  }
}