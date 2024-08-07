  
  <!-- Bootstrap core JavaScript-->
  <script src="../../assests/sidebar/jquery/jquery.min.js"></script>
  <script src="../../assests/sidebar/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../assests/sidebar/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../assests/js/sb-admin-2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>


  <!-- Page level plugins -->
  <script src="../../assests/sidebar/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../assests/js/demo/chart-area-demo.js"></script>
  <script src="../../assests/js/demo/chart-pie-demo.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" rel="stylesheet"></script>
<script>
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
   <script>
    new DataTable('#datatableid');
  </script>
  
  <script>
$(function() {
  $('input[name="dates"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10)
  }, function(start, end, label) {
    var years = moment().diff(start, 'years');
    //alert("You are " + years + " years old!");
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
jQuery('#Export to excel').bind("click", function() {
var target = $(this).attr('id');
switch(target) {
  case 'export-to-excel' :
  $('#hidden-type').val(target);
  //alert($('#hidden-type').val());
  $('#export-form').submit();
  $('#hidden-type').val('');
  break
}
});
    });
</script>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');
?>

