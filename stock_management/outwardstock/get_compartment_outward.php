<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    if(isset($_POST["customer"]) && isset($_POST["warehouse"]))
    {
        $customer_id = $_POST["customer"];
        $warehouse_id = $_POST["warehouse"];
        $comp_id = $_POST["compartment"];
        

        $gen = new Generic();
        $result = $gen->getCompartmentByCustomerWarehouse($customer_id, $warehouse_id);
        if (!empty($result)) 
        {
    ?>
        <option value="">Select Compartment</option>   
    <?php
            
        while($row = mysqli_fetch_array($result))
            {
    ?>
                <option value ="<?php echo $row["id"]; ?>" <?php if($row["id"] == $comp_id){ echo "Selected";}?> ><?php echo $row["compartment_name"]; ?></option>
    <?php
            }
        }
     }
?> 