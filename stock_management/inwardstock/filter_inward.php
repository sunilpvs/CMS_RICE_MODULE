<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    include('../includes/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/inwardstock/Inwardstock.php");
    
    if(isset($_POST["date_picker"]))
    {
        $output = '';
        $dt = $_POST["date_picker"];
        $newDate = date("d-M-Y", strtotime($dt));
        $inwardstock = new Inwardstock();
        $result = $inwardstock->getAllInwardstock($newDate);
        $count = mysqli_num_rows($result);
        $output .= '
            <table id ="datatableid" class="table table-bordered table-dark" style="width:100%" >
            <thead style="background-color:#4e73df;">
                <tr style="font-size:14px;">
                    <th><strong>Id</strong></th> 
                    <th><strong>Date</strong></th> 
                    <th><strong>Inv.Number</strong></th>
                    <th><strong>Inv.Date</strong></th>
                    <th><strong>Miller</strong></th> 
                    <th><strong>Commodity</strong></th>
                    <th><strong>TransMode</strong></th>
                    <th><strong>Warehouse</strong></th>
                    <th><strong>Compartment</strong></th>
                    <th><strong>Vehicle</strong></th>
                    <th><strong>Bags.Revd(Nos)</strong></th>
                    <th><strong>Net.Wt</strong></th>
                    <th><strong>Weighbridge.Wt</strong></th>
                    <th><strong>Wt.Difference</strong></th>
                    <th><strong>Remarks</strong></th>
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
                    <td>'.$row["received_date"].'</td>
                    <td>'.$row["invoice_no"].'</td>
                    <td>'.$row["invoice_date"].'</td>
                    <td>'.$row["miller_name"].'</td>
                    <td>'.$row["commodity"].'</td>
                    <td>'.$row["source_transport"].'</td>
                    <td>'.$row["warehouse_name"].'</td>
                    <td>'.$row["compartment_name"].'</td>
                    <td>'.$row["vehicle_no"].'</td>
                    <td>'.$row["inward_bags_stock"].'</td>
                    <td>'.$row["inward_net_wt"].'</td>
                    <td>'.$row["inward_wb_net_wt"].'</td>
                    <td>'.$row["inward_diff_net"].'</td>
                    <td>'.$row["remarks"].'</td>
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

    include('../includes/scripts.php');
?>