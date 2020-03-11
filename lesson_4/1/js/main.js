
document.addEventListener("DOMContentLoaded", function() {
  document.querySelector("#figures").addEventListener("click", onFigureClick);
});

function addCircle() {
  var div = document.createElement('div');
  var child = document.createElement('div');
  div.appendChild(child);
  div.classList.add('circle');  
  document.querySelector('#figures').appendChild(div);
}

function addSquare() {
  var div = document.createElement('div');
  var child = document.createElement('div');
  div.appendChild(child);
  div.classList.add('square');
  document.querySelector('#figures').appendChild(div);
}

function onFigureClick(ev) {
  var elm = ev.target;
  while (elm) {
  	if (elm.classList.contains("circle") || elm.classList.contains("square")) {
  	  elm.classList.toggle('boundary');
  	  break;
    }
    elm = elm.parentNode;	
  }
  
}