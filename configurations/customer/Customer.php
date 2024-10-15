<?php 

 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
class Customer
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
                        
    function addCustomer($customer_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $created_by)
     {
        $last_UpdatedDateTime =  date("Y-m-d H:i:s");
            $this->db_handle->beginTrans();
            try{
        $query = "INSERT INTO tbl_customer (customer_name, add1, add2, city, state, pin, country, primary_contact, status, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssiiiiisi";
        $paramValue = array(
            $customer_name,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $primary_contact,
            $status,
            $created_by
        );
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        $activity = "New Customer Details are added with ID: $insertId";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $created_by
        );
		$transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);
 $this->db_handle->commitTrans();
            return $insertId;
            }catch (\Throwable $e){
            // An exception has been thrown
            // We must rollback the transaction
            $this->db_handle->rollbackTrans();
            throw $e; // but the error must be handled anyway
        }
        }

    function editCustomer($customer_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $customer_id) 
    {
        $last_updated = $_SESSION['id'];
        $last_updateddatetime =  date("Y-m-d H:i:s");

        $query = "UPDATE tbl_customer SET customer_name = ?, add1 = ?, add2 = ?, city = ?, state = ?, pin = ?, country = ?, status =?, primary_contact = ?, ";
        $query .= " last_updated = ?, last_updateddatetime = ? WHERE id = ?";
        $paramType = "sssiiiisiisi";
        $paramValue = array(
            $customer_name,
            $add1,
            $add2,
            $city,
            $state,
            $pin,
            $country,
            $status,
            $primary_contact,
            $last_updated,
            $last_updateddatetime,
            $customer_id
        );
        $updateId = $this->db_handle->insert($query, $paramType, $paramValue);
        
        $activity = "Updated customer details for customer ID: $customer_id";
        $trans_query = "INSERT INTO tbl_transaction_log (activity,action_user_id) VALUES(? ,?);";
        $paramType = "si";
        $paramValue = array(
            $activity,
            $last_updated
        );
        $transid = $this->db_handle->insert($trans_query, $paramType, $paramValue);        
        return $updateId;
    }

    function deleteCustomer($customer_id) 
    {
        $query = "DELETE FROM tbl_customer WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $customer_id
          
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getCustomerById($id) 
    {
        $query = "SELECT * FROM tbl_customer WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );    
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    
    function validateCustomername($customer_name) {
        $sql = "SELECT customer_name FROM vw_customer WHERE customer_name = '$customer_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    function validateCustomernameEdit($customer_name,$customer_id) {
        $sql = "SELECT customer_name FROM vw_customer WHERE id != $customer_id  AND customer_name = '$customer_name'";
        $result = $this->db_handle->runBaseQuery($sql);
        $count=mysqli_num_rows($result);
        if($count>0){ //cc_code Exists
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    
    function getAllCustomer() 
    {
        $sql = "SELECT * FROM vw_customer;";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
    
    function getCustomerContactList() 
    {
        $sql = "Select id, f_name,l_name from tbl_contact WHERE ContactType_Id = 3 ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>