<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    include('../../includes/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/outwardstock/Outwardstock.php");
?>

<?php
    if(isset($_POST["date_picker"]))
    {
        $output = '';
        $dt = $_POST["date_picker"];
        $newDate = date("d-M-Y", strtotime($dt));
        $outwardstock = new Outwardstock();
        $result = $outwardstock->getAllOutwardstock($newDate);
        $count=mysqli_num_rows($result);
        $output .= '
            <table id ="datatableid" class="table table-bordered table-dark" style="width:100%" >
            <thead style="background-color:#4e73df;">
                <tr style="font-size:14px;"
                <th><strong>Id</strong></th> 
                <th><strong>Transaction Date</strong></th> 
                <th><strong>Commodity</strong></th>
                <th><strong>Warehouse</strong></th>
                <th><strong>Compartment</strong></th>
                <th><strong>Vehicle Number</strong></th>
                <th><strong>Bags Out</strong></th>
                <th><strong>Net.Wt</strong></th>
                <th><strong>Delivery</strong></th>
                </tr>
            </thead>
            <tbody style="background-color:#ffffff; color: #000000;">    
            ';
        if ($count > 0) 
        {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $output .= '
                    <tr style="font-size:12px;">
                    <td>'.$row["id"].'</td>
                    <td>'.$row["transaction_date"].'</td>
                    <td>'.$row["commodity"];'</td>
                    <td>'.$row["warehouse_name"].'</td>
                    <td>'.$row["compartment_name"].'</td>
                    <td>'.$row["vehicle_no"].'</td>
                    <td>'.$row["bags_out"].'</td>
                    <td>'.$row["outward_net_wt"].'</td>
                    <td>'.$row["delivery_name"].'</td>
                    </tr>
                    ';
            }
        }
        else
        {

        }    
        $output .= '
                </tbody>
                </table>
                ';
        echo $output;
    }

    include('../../includes/scripts.php');
?>