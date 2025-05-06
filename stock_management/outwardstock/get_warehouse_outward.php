<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    if(isset($_POST["customer"]))
    {
        $id = $_POST["customer"];
        $wid= $_POST["w_id"];
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
                <option value ="<?php echo $row["warehouse_id"]; ?>" <?php if($wid == $row["warehouse_id"]){echo "Selected";} ?> ><?php echo $row["warehouse_name"]; ?></option>
    <?php
                }
            }
        }
    }
?> 