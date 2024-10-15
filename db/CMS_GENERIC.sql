SELECT * FROM tbl_lessor;
SELECT * FROM tbl_warehouse;
SELECT * FROM tbl_inwardlease;
SELECT * FROM tbl_outwardlease;
SELECT * FROM tbl_compartment;
SELECT * FROM tbl_customer;
SELECT * FROM tbl_commodity_stock;
SELECT * FROM tbl_inwardstock;
SELECT * FROM tbl_outwardstock;

SELECT * FROM tbl_commodity_stock WHERE compartment_id = 003 AND commodity_id = 2;
SELECT * FROM tbl_inwardstock WHERE compartment_id = 003 AND commodity_id = 2;
SELECT * FROM tbl_inwardstock where compartment_id = 3;

SELECT * FROM vw_outwardstock_list



    select * from tbl_outwardstock
    select current_bags_stock from tbl_inwardstock where compartment_id = 003 

CALL sp_ReleaseExpiredOutwardLeaseCapacity();

SELECT id, lease_model,warehouse_id,lease_capacity_sqft,lease_capacity_mton FROM tbl_outwardlease
WHERE DATE_FORMAT(lease_end,'%Y-%m-%d') <= DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d') AND release_capacity=0;



select * from tbl_transport_mode

SELECT a.id as comp_id, concat(b.warehouse_name,'-',a.compartment_name) as godown 
	FROM tbl_compartment a, tbl_warehouse b 
WHERE a.warehouse_id = b.id ORDER BY a.id;

SELECT * FROM 



customer --> active_outward_lease (lease_capacity) --> identify warehouse to create compartments..

select * from tbl_userpermissions
select * from tbl_pagemaster 
select * from tbl_userroles
SELECT a.id as comp_id, concat(b.warehouse_name,'-',a.compartment_name) as godown FROM tbl_compartment a, tbl_warehouse b 
         WHERE a.warehouse_id = b.id ORDER BY a.id;





select * from tbl_commodity
select * from tbl_compartment

SELECT commodity,compartment_name,inward_bags_stock,current_bags_stock,compartment_id FROM vw_inwardstock shric8ey_demo_cms(27-Feb-2024)WHERE compartment_id=1

SELECT * FROM vw_inwardstock

SELECT warehouse_id , start_date, expiry_date FROM tbl_inwardlease WHERE warehouse_id = 0002 AND "2024-07-28" >= DATE_FORMAT(start_date,'%Y-%m-%d') AND
"2024-07-28" <= DATE_FORMAT(expiry_date,'%Y-%m-%d');

SELECT warehouse_id,start_date,expiry_date FROM tbl_inwardlease 
WHERE warehouse_id = 0002 AND 
	'2024-02-22' >= DATE_FORMAT(start_date,'%Y-%m-%d') AND '2024-02-22' <= DATE_FORMAT(expiry_date,'%Y-%m-%d')

SELECT warehouse_id,start_date,expiry_date FROM tbl_inwardlease WHERE warehouse_id = 0002 
AND  DATE_FORMAT(expiry_date,'%Y-%m-%d') >= '2024-02-28'

DATE_FORMAT(b.lease_end,'%d-%b-%Y')

SELECT DATE_FORMAT(Now(),'%Y-%m-%d')

SELECT DATE_FORMAT(Now(),'%d-%b-%Y')

SELECT * FROM tbl_outwardlease WHERE warehouse_id = 0002;
select * from tbl_inwardlease  WHERE warehouse_id = 0002;

SELECT * FROM tbl_inwardstock WHERE commodity_id = 1 AND compartment_id = 1



select * from vw_outwardstock_list

select a.id,d.warehouse_name,c.compartment_id,c.compartment_name,b.commodity,a.bags_rec from tbl_inwardstock a, tbl_commodity b, tbl_compartment c, tbl_warehouse d
where a.commodity_id = b.id and a.compartment_id = c.id and c.warehouse_id = d.id

SELECT warehouse_id,sum(capacity_sqft),sum(capacity_mton) FROM tbl_compartment WHERE warehouse_id = 1 AND status ='A'
group by warehouse_id LIMIT 1

select * from tbl_commodity;


SELECT a.id as warehouse_id, a.warehouse_name 
        FROM tbl_warehouse a, tbl_outwardlease b
        WHERE a.id = b.warehouse_id AND DATE_FORMAT(b.lease_end,'%d-%b-%Y') >= DATE_FORMAT(Now(),'%d-%b-%Y') 



SELECT a.compartment_id, a.capacity_sqft, a.capacity_mton
FROM tbl_compartment a, tbl_warehouse b
WHERE a.warehouse_id = b.id;

SELECT * FROM vw_outwardlease_combo;

SELECT id,commodity FROM vw_commodities WHERE id =1;
SELECT * FROM vw_activitylog WHERE id = $id LIMIT 50;
SELECT id,concat(cargo_type,'-',commodity_name,'-',brand,'-',marking) as commodity,empty_bag_wt,bag_wt FROM vw_commodities WHERE status ='A';

SELECT b.id as warehouse_id, b.warehouse_name , a.compartment_code
FROM tbl_outwardlease a, tbl_warehouse b
WHERE a.warehouse_id = b.id AND DATE_FORMAT(a.lease_end,'%d-%b-%Y') >= DATE_FORMAT(Now(),'%d-%b-%Y') 

SELECT id,miller_name,gst_num,place FROM tbl_miller WHERE status = 'A'


select * from vw_outwardleases

SELECT * FROM vw_warehouse_leases
SELECT * FROM tbl_status

SELECT * FROM tbl_customer
SELECT * FROM tbl_lease_model
SELECT * FROM tbl_mod_status

SELECT * FROM vw_warehouse_leases
avl_sqft
avl_mton
SELECT * FROM vw_warehouse_leases

update tbl_outwardlease set lease_end = '2023-09-02' where id = 2

group by warehouse_id

SELECT * FROM vw_outwardleases

INSERT INTO tbl_outwardlease (warehouse_id,customer_id,lease_contract_id,lease_model,compartment_code,lease_start,lease_end,lease_capacity_sqft,daily_rate_sqft,lease_status) 
	VALUES (1,1,'C23001',1,'C1','2023/08/03','2023/09/02',60450,10.5,'A');
    
UPDATE tbl_outwardlease SET lease_end = '2023/09/12' where id = 1;    


SELECT * FROM vw_outwardleases

SELECT * FROM vw_warehouse_leases

SELECT * FROM tbl_lease_model ORDER BY lease_model

SELECT * FROM tbl_mod_status
SELECT * FROM tbl_status

SELECT ID,Status FROM vw_status;

SELECT id,customer_name FROM tbl_customer WHERE status = 'A' ORDER BY id

update tbl_customer set customer_name = 'OLAM INTERNATIONAL', primary_contact =60 where id =1

SELECT a.id, a.warehouse_name, a.code, b.lessor_name, c.ltype, a.capacity_sqft,a.capacity_mton, h.contract_id, DATE_FORMAT(h.start_date,'%d-%b-%Y') as start_date, 
		DATE_FORMAT(h.expiry_date,'%d-%b-%Y') as expiry_date, d.city, e.state, concat(g.f_name,' ', g.l_name) as contact, g.email, g. mobile, a.status
FROM tbl_warehouse a, tbl_lessor b, tbl_lessortype c, tbl_city d, tbl_state e, tbl_country f, tbl_contact g, tbl_inwardlease h
WHERE a.lessor_id = b.id AND b.ltype = c.id AND a.city = d.id AND a.state = e.id AND a.country = f.id AND a.primary_contact = g.id AND a.id = h.warehouse_id
AND a.status = 'A'
ORDER BY a.id;

SELECT * FROM tbl_inwardlease

SELECT a.id, concat 
FROM tbl_warehouse a, tbl_inwardlease b
WHERE a.id = b.warehouse_id


SELECT id,warehouse_name FROM vw_warehouselist;";







SELECT * FROM tbl_lease_model



SELECT * FROM tbl_inwardmode
select * from tbl_warehouse

select * from vw_warehouse
select * from vw_warehouselist

INSERT INTO tbl_users () 
	VALUES ('root','donotreply@pvs-consultancy.com','$2y$10$K8erDeTeJj7XMuE3uQtt8O8I5exRsH7y.bcGxs.QrT6ZhzhwpSU1G'

select * from tbl_user_role

select warehouse_id,max(expiry_date) from tbl_inwardlease
group by warehouse_id;

vw_activitylogtbl_userstbl_users

ALTER DATABASE pvscoqq5_devsc_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

SELECT * FROM tbl_inwardlease

SELECT * FROM tbl_warehouse a, tbl_inwardlease b
WHERE a.id = b.warehouse_id AND

SELECT * FROM tbl_warehouse 

SELECT * FROM vw_warehouselist;

	SELECT id,concat(code,' - ',warehouse_name) as warehouse_name 
	FROM tbl_warehouse 
	WHERE status = 'A' AND id not in (SELECT warehouse_id FROM tbl_inwardlease WHERE expiry_date >= CURDATE())
	ORDER BY id;

WHERE module = 'Lease'


SELECT * FROM tbl_mod_status;

INSERT INTO tbl_mod_status (code,status,module) VALUES ('E','Expired','Lease');


SELECT * FROM vw_inwardleases

SELECT id,ltype FROM tbl_leasetype ORDER BY id

select * from tbl_warehouse


SELECT * FROM tbl_inwardlease

SELECT * FROM tbl_leasetype

select * from tbl_status

SELECT id,lessor_name FROM vw_lessor

select * from tbl_transaction_log
SELECT id, ltype FROM tbl_lessortype  ORDER BY id

select * from tbl_contacttype

SELECT id, contact, ctype FROM vw_contact WHERE ctype = 4;

SELECT * FROM tbl_leasetype

SELECT * FROM vw_vendorlist

SELECT * FROM vw_vendor

add
id,customer_name,add1,add2,city,state,pin,country,status,primary_contact,created_by
edit
id,customer_name,add1,add2,city,state,pin,country,status,primary_contact,last_updated,last_updateddatetime


select * from tbl_contacttype
select * from tbl_contact



ContactType_Id
select * from tbl_transaction_log