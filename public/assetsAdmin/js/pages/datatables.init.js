$(document).ready(function(){
    $("#datatable").DataTable(),
    $("#datatable-buttons").DataTable({
        lengthChange:!1,
        "ordering": false,
        buttons:["excel","pdf","colvis"],
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")});
