$(document).ready( function () {
    $('.datatable_style').DataTable({
    // paging: false,
    // info: false,
    searching: false,
  });

  $('.datatable_style2').DataTable({
    // "columns": [
    //   { "width": "30%" },
    //   { "width": "50%" },
    //   null
    // ],
    paging: false,
    info: false,
    ordering:  false,
    searching: false,
});

$('.datatable_style3').DataTable({
  // "columns": [
  //   { "width": "30%" },
  //   { "width": "50%" },
  //   null
  // ],
  "pageLength": 4,
  info: false,
  ordering:  false,
  searching: false,
});

  // search script
  $(".search-for").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".search-table tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  // hide label for enquiry replies if there is no reply
  if (!$.trim($("#enquiry_reply").val())){
    $("#reply-label").hide();
  }

} );

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
