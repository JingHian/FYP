$(document).ready( function () {
    $('.datatable_style').DataTable({
    paging: false,
    // info: false,
    searching: false,
  });

  // search script
  $(".search-for").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".search-table tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

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

const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            barThickness: 26,
            label: 'water usage',
            data: [12, 22, 3, 5, 2, 3, 22, 3, 5, 2, 3,14],
            backgroundColor: [
                'rgba(54, 162, 235, 0.8)'
            ],
            borderColor: [
                  'rgba(54, 162, 235, 0.8)',
            ],
            borderWidth: 1
        }]
    },
    options: {
      responsive:true,
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: {
            display: false
          }
        },
          y: {
            grid: {
              display: false
            },
              beginAtZero: true
          }
      },
      plugins: {
               legend: {
                  display: false
               }
            }
    }
});
