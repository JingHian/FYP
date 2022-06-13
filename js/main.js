$( document ).ready(function(){

});

$('#add_service').on('click', add);
var counter = 0;

function add() {
  var new_input = '<div class=" form-floating mt-3 mb-3  "><input type="text" class="form-control"  name="services[]" placeholder="Others">  <label for="services">Others</label>  </div>';
  if (counter < 3){
    $('.last_service').append(new_input);
  }
  else if (counter == 3){
    $('.last_service').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
    'Max number of fields reached!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
  }
  counter++;
  console.log(counter);
}
