function addCircle() {
  var div = document.createElement('div');
  
  div.classList.add('circle');
  div.addEventListener('click', onFigureClick);
  
  document.querySelector('.figures').appendChild(div);
}

function addSquare() {
  var div = document.createElement('div');
  
  div.classList.add('square');
  div.addEventListener('click', onFigureClick);
  
  document.querySelector('.figures').appendChild(div);
}

function onFigureClick() {
  this.classList.toggle('boundary');
}