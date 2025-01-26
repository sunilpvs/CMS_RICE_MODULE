<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
	$inward_result = $report->getCustomerInwardStock();
	$outward_result = $report->getCustomerOutwardStock();
	if (! empty($inward_result)) {
		while ($inward_row = mysqli_fetch_array($inward_result, MYSQLI_ASSOC))
		{    
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>CMS - Daily Customer Stock Report</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Lato:wght@100;400;900&display=swap');

:root {
  --primary: #0000ff;
  --secondary: #3d3d3d; 
  --white: #fff;
}

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Lato', sans-serif;
}

body{
	background: var(--secondary);
	padding: 50px;
	color: var(--secondary);
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 14px;
}

.bold{
	font-weight: 900;
}

.light{
	font-weight: 100;
}

.wrapper{
	background: var(--white);
	padding: 30px;
}

.invoice_wrapper{
	border: 3px solid var(--primary);
	width: 700px;
	max-width: 100%;
}

.invoice_wrapper .header .logo_invoice_wrap,
.invoice_wrapper .header .bill_total_wrap{
	display: flex;
	justify-content: space-between;
	padding: 30px;
}

.invoice_wrapper .header .logo_sec{
	display: flex;
	align-items: center;
}

.invoice_wrapper .header .logo_sec .title_wrap{
	margin-left: 5px;
}

.invoice_wrapper .header .logo_sec .title_wrap .title{
	text-transform: uppercase;
	font-size: 18px;
	color: var(--primary);
}

.invoice_wrapper .header .logo_sec .title_wrap .sub_title{
	font-size: 12px;
}

.invoice_wrapper .header .invoice_sec,
.invoice_wrapper .header .bill_total_wrap .total_wrap{
	text-align: right;
}

.invoice_wrapper .header .invoice_sec .invoice{
	font-size: 28px;
	color: var(--primary);
}

.invoice_wrapper .header .invoice_sec .invoice_no,
.invoice_wrapper .header .invoice_sec .date{
	display: flex;
	width: 100%;
}

.invoice_wrapper .header .invoice_sec .invoice_no span:first-child,
.invoice_wrapper .header .invoice_sec .date span:first-child{
	width: 70px;
	text-align: left;
}

.invoice_wrapper .header .invoice_sec .invoice_no span:last-child,
.invoice_wrapper .header .invoice_sec .date span:last-child{
	width: calc(100% - 70px);
}

.invoice_wrapper .header .bill_total_wrap .total_wrap .price,
.invoice_wrapper .header .bill_total_wrap .bill_sec .name{
	color: var(--primary);
	font-size: 20px;
}

.invoice_wrapper .body .main_table .table_header{
	background: var(--primary);
}

.invoice_wrapper .body .main_table .table_header .row{
	color: var(--white);
	font-size: 18px;
	border-bottom: 0px;	
}

.invoice_wrapper .body .main_table .row{
	display: flex;
	border-bottom: 1px solid var(--secondary);
}

.invoice_wrapper .body .main_table .row .col{
	padding: 10px;
}
.invoice_wrapper .body .main_table .row .col_no{width: 5%;}
.invoice_wrapper .body .main_table .row .col_des{width: 45%;}
.invoice_wrapper .body .main_table .row .col_price{width: 20%; text-align: center;}
.invoice_wrapper .body .main_table .row .col_qty{width: 10%; text-align: center;}
.invoice_wrapper .body .main_table .row .col_total{width: 20%; text-align: right;}

.invoice_wrapper .body .paymethod_grandtotal_wrap{
	display: flex;
	justify-content: space-between;
	padding: 5px 0 30px;
	align-items: flex-end;
}

.invoice_wrapper .body .paymethod_grandtotal_wrap .paymethod_sec{
	padding-left: 30px;
}

.invoice_wrapper .body .paymethod_grandtotal_wrap .grandtotal_sec{
	width: 30%;
}

.invoice_wrapper .body .paymethod_grandtotal_wrap .grandtotal_sec p{
	display: flex;
	width: 100%;
	padding-bottom: 5px;
}

.invoice_wrapper .body .paymethod_grandtotal_wrap .grandtotal_sec p span{
	padding: 0 10px;
}

.invoice_wrapper .body .paymethod_grandtotal_wrap .grandtotal_sec p span:first-child{
	width: 60%;
}

.invoice_wrapper .body .paymethod_grandtotal_wrap .grandtotal_sec p span:last-child{
	width: 40%;
	text-align: right;
}

.invoice_wrapper .body .paymethod_grandtotal_wrap .grandtotal_sec p:last-child span{
	background: var(--primary);
	padding: 10px;
	color: #fff;
}

.invoice_wrapper .footer{
	padding-bottom: 30px;
}

.invoice_wrapper .footer > p{
	color: var(--primary);
	text-decoration: underline;
	font-size: 18px;
	padding-bottom: 5px;
}

.invoice_wrapper .footer .terms .tc{
	font-size: 16px;
}
	</style>
</head>
<body>

<div class="wrapper">
	<div  class="invoice_wrapper">
		<div class="header">
			<center><h2>SHRI CHANDRA BULK CARGO SERVICES PRIVATE LIMITED</h2>
			<h3>Shipping and Logistics</h3></center>
			<center><div class="logo_sec">
					<img src="../../assests/img/logo-scbc.png" alt="code logo">
					<div class="title_wrap">
						<p class="sub_title" style="font-size:13px;line-height:20px;">Head Office ; D:No. 7g-7-62/A,1st Floor, Ramya Royale, Revenue Ward No. 30, Ramanayyapeta, Kakinada<br>
533 003. A.P., lndia, Contact : 9l-884-2361567, 9l-884-2361569, E-mail : scbc@shrichandrabulk.com</p>
<h4>CIN : U74900AP2009PTC064815 GSTIN : 37AAECR9430I1ZX PAN : AAECR9403L</h4>
					</div>
				</div>
			</center>
			<hr>
	
			<div class="bill_total_wrap">
				<div class="bill_sec">
					<p>Bill To</p> 
	          		<p class="bold name">Alex Deo</p>
			        <span>
			           123 walls street, Townhall<br/>
			           +111 222345667
			        </span>
				</div>
				<div class="total_wrap">
					<p>Total Due</p>
	          		<p class="bold price">USD: $1200</p>
				</div>
			</div>
		</div>
		<div class="body">
			<div class="main_table">
				<div class="table_header" style="border:1px; color:#000;">
					<div class="row">
						<div class="col col_no">NO.</div>
						<div class="col col_des">ITEM DESCRIPTION</div>
						<div class="col col_price">PRICE</div>
						<div class="col col_qty">QTY</div>
						<div class="col col_total">TOTAL</div>
					</div>
				</div>

				<div class="table_body">
					<div class="row">
						<div class="col col_no">
							<p>01</p>
						</div>
						<div class="col col_des">
							<p class="bold">Web Design</p>
							
						</div>
						<div class="col col_price">
							<p>$350</p>
						</div>
						<div class="col col_qty">
							<p>2</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>02</p>
						</div>
						<div class="col col_des">
							<p class="bold">Web Development</p>
							
						</div>
						<div class="col col_price">
							<p>$350</p>
						</div>
						<div class="col col_qty">
							<p>2</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>03</p>
						</div>
						<div class="col col_des">
							<p class="bold">GitHub</p>
							
						</div>
						<div class="col col_price">
							<p>$120</p>
						</div>
						<div class="col col_qty">
							<p>1</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>04</p>
						</div>
						<div class="col col_des">
							<p class="bold">Backend Design</p>
							
						</div>
						<div class="col col_price">
							<p>$350</p>
						</div>
						<div class="col col_qty">
							<p>2</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>05</p>
						</div>
						<div class="col col_des">
							<p class="bold">Balance</p>
							
						</div>
						<div class="col col_price">
							<p>$150</p>
						</div>
						<div class="col col_qty">
							<p>1</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<h3  style="padding:10px;">SUB :DELIVERY DETAILS OF BOILED RICE, BROKEN & REJECTION</h3>
		<div class="body">
			<div class="main_table">
				<div class="table_header" style="border:1px; color:#000;">
					<div class="row">
						<div class="col col_no">NO.</div>
						<div class="col col_des">ITEM DESCRIPTION</div>
						<div class="col col_price">PRICE</div>
						<div class="col col_qty">QTY</div>
						<div class="col col_total">TOTAL</div>
					</div>
				</div>

				<div class="table_body">
					<div class="row">
						<div class="col col_no">
							<p>01</p>
						</div>
						<div class="col col_des">
							<p class="bold">Web Design</p>
							
						</div>
						<div class="col col_price">
							<p>$350</p>
						</div>
						<div class="col col_qty">
							<p>2</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>02</p>
						</div>
						<div class="col col_des">
							<p class="bold">Web Development</p>
							
						</div>
						<div class="col col_price">
							<p>$350</p>
						</div>
						<div class="col col_qty">
							<p>2</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>03</p>
						</div>
						<div class="col col_des">
							<p class="bold">GitHub</p>
							
						</div>
						<div class="col col_price">
							<p>$120</p>
						</div>
						<div class="col col_qty">
							<p>1</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>04</p>
						</div>
						<div class="col col_des">
							<p class="bold">Backend Design</p>
							
						</div>
						<div class="col col_price">
							<p>$350</p>
						</div>
						<div class="col col_qty">
							<p>2</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
					<div class="row">
						<div class="col col_no">
							<p>05</p>
						</div>
						<div class="col col_des">
							<p class="bold">Balance</p>
							
						</div>
						<div class="col col_price">
							<p>$150</p>
						</div>
						<div class="col col_qty">
							<p>1</p>
						</div>
						<div class="col col_total">
							<p>$700.00</p>
						</div>
					</div>
				</div>
			</div>
			<div class="logo_sec" style="padding:20px;">
					<img src="logo-scbc.png" alt="code logo" style="float:right;">
					
				</div>
		
		<div class="footer" style="margin-top:50px;padding:">
			 <hr>
			<div class="terms">
		       
		        <center><p>Branches: Visakhapatnam, Krishnapatnam, Chennai, Hyderabad, Guntur, Bengaluru, Mumbai<br>Associted Branches : ln All Major & Minor Ports in East and West Coast of India</p>
		    </div></center>
		</div>
	</div>
</div>


</body>
</html>