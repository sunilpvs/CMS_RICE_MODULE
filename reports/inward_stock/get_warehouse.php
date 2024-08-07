<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    if(isset($_POST["customer"]))
    {
        $id = $_POST["customer"];
        if(!empty($id))
        {
            $gen = new Generic();
            $result = $gen->getWarehouseByCustomer($id);
            if (!empty($result)) 
            {
    ?>
          <option value="">Select Warehouse</option>   
    <?php
            
            while($row = mysqli_fetch_array($result))
                {
    ?>
                <option value ="<?php echo $row["warehouse_id"]; ?>"><?php echo $row["warehouse_name"]; ?></option>
    <?php
                }
            }
        }
    }
?> 