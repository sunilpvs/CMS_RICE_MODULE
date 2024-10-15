<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/inwardstock/Inwardstock.php");
    $customer_id = $_POST['customer_id'];
    $warehouse_id = $_POST['warehouse_id'];
    $compartment_id = $_POST['compartment_id']; 
    $commodity_id = $_POST["commodity_id"];
    $mod_transport = $_POST["mod_transport"];

    $in = new Inwardstock();
    $result = $in->getComp_CommodityStock($customer_id,$warehouse_id,$compartment_id,$commodity_id,$mod_transport);
    $count=mysqli_num_rows($result);
    $bags_stock = 0;
    if($count >0)
    {
        $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $bags_stock = $rows["bags_stock"];
        echo $bags_stock;    
    }
    else
    {
        echo $bags_stock;    
    }

    // if(!$result)
    // {
    //     echo "<span style='color:red'>* Invalid capacity(Sqft).</span>";
    //     echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    //   }else{
    //     echo "<span style='color:green'> </span>";
    //     echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
    //   }

?> 