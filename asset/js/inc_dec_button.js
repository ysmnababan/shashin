document.addEventListener("DOMContentLoaded", function() {
    var valueInput = document.getElementById("valueInput");
    var increaseButton = document.getElementById("increaseButton");
    var decreaseButton = document.getElementById("decreaseButton");
  
    increaseButton.addEventListener("click", function() {
      var value = parseInt(valueInput.value);
      valueInput.value = value + 1;
    });
  
    decreaseButton.addEventListener("click", function() {
      var value = parseInt(valueInput.value);
      if (value > 1) {
        valueInput.value = value - 1;
      }
    });
  });