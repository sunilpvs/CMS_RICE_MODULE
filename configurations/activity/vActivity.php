<?php
   include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
  
 ?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Activity Log
        <!-- <a href="/../../masters/contact/cContact.php?action=contact-add" class="btn btn-primary btn-md float-right" role="button">Add Contact</a> -->
    </h3>
  </div>

<div class="card-body">
    <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Minimum date:</td>
            <td><input type="text" id="min" name="min"></td>
        </tr>
        <tr>
            <td>Maximum date:</td>
            <td><input type="text" id="max" name="max"></td>
        </tr>
    </tbody></table>
<div class="table-responsive">   
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%;" >
    <thead style="background-color:#4e73df;">
        <tr style="font-size:14px">
            <th><strong>Date Time</strong></th>
            <th><strong>Activity</strong></th>
            <th><strong>Log</strong></th>
        </tr>
    </thead>
            <tbody style="background-color:#ffffff; color: #000000;">
                    <?php
                    if (! empty($result)) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {    
                    ?>
                    <tr style="font-size:12px">                   
                        <td><?php echo $row["datetime"]; ?></td>
                        <td><?php echo $row["activity"]; ?></td>
                        <td><?php echo $row["log"]; ?></td>                                           
                    </tr>
                    <?php
                        }
                    }
                    ?>
            </tbody>        
   </table>

    </div>
  </div>
</div>

</div>

<script>
    let minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
DataTable.ext.search.push(function (settings, data, dataIndex) {
    let min = minDate.val();
    let max = maxDate.val();
    let date = new Date(data[4]);
 
    if (
        (min === null && max === null) ||
        (min === null && date <= max) ||
        (min <= date && max === null) ||
        (min <= date && date <= max)
    ) {
        return true;
    }
    return false;
});
 
// Create date inputs
minDate = new DateTime('#min', {
    format: 'MMMM Do YYYY'
});
maxDate = new DateTime('#max', {
    format: 'MMMM Do YYYY'
});
 
// DataTables initialisation
let table = new DataTable('#datatableid');
 
// Refilter the table
document.querySelectorAll('#min, #max').forEach((el) => {
    el.addEventListener('change', () => table.draw());
});
</script>




<?php
include('../../includes/scripts.php');
include('../../includes/footer.php');

?>