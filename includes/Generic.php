<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php'); 

    class Generic
    {
        private $db_handle;
        
        function __construct() {
            $this->db_handle = new DBController();
        }


        //Generig Combo Filling Functions Start
        function getStatusList() 
        {
            $sql = "SELECT ID,Status FROM vw_status;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getModStatusList($module) 
        {
            if (empty($module)) 
            {           
                $module = 'Gen';
            }
            $sql = "SELECT id,status FROM vw_mod_status WHERE module = '$module';";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        
        function getDeptartmentList() 
        {
            $sql = "SELECT id,dept FROM vw_deptlist;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getDesignationList() 
        {
            $sql = "SELECT id,desig FROM vw_desiglist;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getContactTypeList() 
        {
            $sql = "SELECT id, ctype FROM vw_ctype WHERE id NOT IN (1,2,5);";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }  

        function getEmployeeTypeList() 
        {
            $sql = "SELECT id, ctype FROM vw_ctype WHERE id IN (2,5);";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        } 

        function getUserRoleList() 
        {
            $sql = "SELECT id,user_role FROM vw_user_roles;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCountryList() {
            $sql = "SELECT id, country FROM vw_country";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getStateList() {
            $sql = "SELECT id, state FROM vw_state";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCityList() {
            $sql = "SELECT id, city FROM vw_city";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
    
        function getEntityList() 
        {
            $sql = "SELECT id, entity_name FROM tbl_entity WHERE status = 'A' ORDER BY id";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getEmpList() 
        {
            $sql = "SELECT id, concat(f_name,' ',l_name) as employee FROM tbl_contact WHERE ContactType_Id IN (2,5) ORDER BY id";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getEmployeeContactList() 
        {
            $sql = "SELECT id, contact, ctype FROM vw_contact WHERE ctype IN (2,5);";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getCustomerContactList() 
        {
            $sql = "SELECT id, contact, ctype FROM vw_contact WHERE ctype = 3;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getVendorContactList() 
        {
            $sql = "SELECT id, contact, ctype FROM vw_contact WHERE ctype = 4;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getAllProfile() 
        {
            $sql="SELECT * FROM tbl_contact";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        } 
        function getProfileById($id) {
            $query = "SELECT * FROM tbl_contact WHERE id = ?";
            $paramType = "i";
            $paramValue = array(
                $id
            );        
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }
    
        function getLessorTypeList() {
            $sql = "SELECT id, ltype FROM tbl_lessortype  ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getLessorList() {
            $sql = "SELECT id,lessor_name FROM vw_lessor;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getLessorContactList() {
            $sql = "SELECT id, contact, ctype FROM vw_contact WHERE ctype = 6;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    
        
        function getWarehouseList() {
            $sql = "SELECT id,warehouse_name FROM vw_warehouselist;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getWarehouseLeases() {
            $sql = "SELECT * FROM vw_warehouse_leases;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }  
        
        function getOutwardleaseCombo() {
            $sql = "SELECT * FROM vw_outwardlease_combo;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }  

       

        function getLeaseTypeList() {
            $sql = "SELECT id,ltype FROM tbl_leasetype ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getCustomerList() {
            $sql = "SELECT id,customer_name FROM tbl_customer WHERE status = 'A' ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getLeaseModelList() {
            $sql = "SELECT * FROM tbl_lease_model ORDER BY lease_model;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        //Generic Combo Filling Functions End

        function getUserProfile() 
        {
            $id = $_SESSION['id'] ;
            $sql = "SELECT * FROM vw_user_profile WHERE id = $id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }  
        
        function getCurrentStock() 
        {
            $id = $_SESSION['id'] ;
            $sql = "SELECT * FROM vw_rpt_currentstock;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        } 


        function getOutwardStockStock() 
        {
            $id = $_SESSION['id'] ;
            $sql = "SELECT * FROM vw_outwardstock_list;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getActivityLog() 
        {
            $id = $_SESSION['id'] ;
            $sql = "SELECT * FROM vw_activitylog WHERE id = $id LIMIT 50;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }    

        function getUserRole($user_id) 
        {
            $sql = "SELECT * FROM vw_userrole WHERE id = $user_id;";
            $result = $this->db_handle->runBaseQuery($sql);
            $count=mysqli_num_rows($result);
            $role = "";
            if($count>0){ //User_Id Exists
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $role = $row["user_role"];
            }
            return $role;
        }

        function getCargoTypeList() 
        {
            $sql = "SELECT id,name FROM tbl_cargo_types ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getInwardmodeTypeList() 
        {
            $sql = "SELECT id,name FROM tbl_inwardmode ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCargoDetailsList() 
        {
            $sql = "SELECT id,name FROM tbl_cargo_details ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
        
        function getBagWeightList() 
        {
            $sql = "SELECT id,weight FROM tbl_bag_weight ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
          
        function getInwardModeList() 
        {
            $sql = "SELECT id,name FROM tbl_inwardmode ORDER BY id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }


        //Generic Functions Start

        function exportExcel($data_records)
        {
            $filename = "data_export_".date('Ymd') . ".xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            $show_coloumn = false;
            if(!empty($data_records)) 
            {
                foreach($data_records as $record) 
                {
                    if(!$show_coloumn) 
                    {
                        // display field/column names in first row
                        echo implode("\t", array_keys($record)) . "\n";
                        $show_coloumn = true;
                    }
                    echo implode("\t", array_values($record)) . "\n";
                }
            }
        }
        
        function dateDiff($lease_start, $lease_end)
        {
            $lease_start_ts = strtotime($lease_start);
            $lease_end_ts = strtotime($lease_end);
            $diff = $lease_end_ts - $lease_start_ts;
            return round($diff / 86400);
        }

        // function get_image($path = ''):string 
        // {
	    //    if(file_exists($path))
	    //    {
		//       return $path;
	    //    }
	    //       return './images/no-image.jpg';
        // } 

        //Generic Functions End
        function getMillerList() 
        {
            $sql = "SELECT id, miller_name FROM tbl_miller WHERE status = 'A' ORDER BY id";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
        function getCommodityList() 
        {
            $sql = "SELECT id, commodity FROM tbl_commodity WHERE status = 'A' ORDER BY id";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getWarehousesList() 
        {
            $sql = "SELECT id, warehouse_name FROM tbl_warehouse WHERE status = 'A' ORDER BY id";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getWarehouseByCustomer($customer_id)
        {
            $sql = "SELECT DISTINCT a.id as warehouse_id, a.warehouse_name ";
			$sql .= " FROM tbl_warehouse a, tbl_outwardlease b, tbl_customer c ";
			$sql .= " WHERE a.id = b.warehouse_id AND c.id = b.customer_id AND c.id = $customer_id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCompartmentByCustomerWarehouse($customer_id, $warehouse_id)
        {
            $sql = "SELECT DISTINCT d.id, d.compartment_name ";
			$sql .= " FROM tbl_warehouse a, tbl_outwardlease b, tbl_customer c, tbl_compartment d ";
			$sql .= " WHERE a.id = b.warehouse_id AND c.id = b.customer_id AND a.id = d.warehouse_id AND b.id = d.outwardlease_id ";
            $sql .= " AND c.id = $customer_id AND a.id = $warehouse_id;";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCompartmentsList() 
        {
            $sql = "SELECT compartment_name FROM vw_compart_outward";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getCompartmentsByWarehouse($warehouse_id, $customer_id) 
        {
            if ($warehouse_id == 0 || $customer_id == 0)
            {
                $sql = "SELECT a.id, a.compartment_name FROM tbl_compartment a, tbl_outwardlease b, tbl_warehouse c, tbl_customer d ";
                $sql .= "WHERE a.outwardlease_id = b.id AND a.warehouse_id = c.id AND b.customer_id = d.id AND b.warehouse_id = c.id ";    
            }
            else if ($warehouse_id != 0 && $customer_id != 0)
            {
                $sql = "SELECT a.id, a.compartment_name FROM tbl_compartment a, tbl_outwardlease b, tbl_warehouse c, tbl_customer d ";
                $sql .= "WHERE a.outwardlease_id = b.id AND a.warehouse_id = c.id AND b.customer_id = d.id AND b.warehouse_id = c.id ";
                $sql .= " AND b.customer_id = $customer_id AND a.warehouse_id = $warehouse_id;";    
            }
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }

        function getTransportModeList() 
        {
            $sql = "SELECT * FROM tbl_transport_mode ORDER BY id";
            $result = $this->db_handle->runBaseQuery($sql);
            return $result;
        }
    }
?>