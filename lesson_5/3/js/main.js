
function addSquare() {
  var div = document.createElement('div');
  div.classList.add('square');
  document.querySelector('.first').appendChild(div);
  div.addEventListener('click', function () {
      if (this.parentNode.classList.contains('first')) {
        this.style.background = 'green';
        document.querySelector('.second').appendChild(this);
      } else {
        this.style.background = '';
        document.querySelector('.first').appendChild(this);
      }
  });
}
