<?php
function fetch_data()  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "Rollout@123#", "pvscoqq5_devsc_cms");  
      $sql = "SELECT * FROM vw_costcenter_list ORDER BY id ASC";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {      
      $output .= '<tr>  
                          <td>'.$row["id"].'</td>  
                          <td>'.$row["entity_name"].'</td>  
                          <td>'.$row["cc_code"].'</td>  
                          <td>'.$row["cc_type"].'</td>  
                          <td>'.$row["incorp_date"].'</td> 
                          <td>'.$row["gst_no"].'</td> 
                          <td>'.$row["city"].'</td> 
                          <td>'.$row["state"].'</td> 
                          <td>'.$row["f_name"].'</td> 
                          <td>'.$row["l_name"].'</td> 
                          <td>'.$row["status"].'</td>  
                     </tr>  
                          ';  
      }  
      return $output;  
 }  
 if(isset($_POST["create_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '
      <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="5%">id</th>  
                <th width="30%">entity_name</th>  
                <th width="10%">cc_code</th>  
                <th width="45%">cc_type</th>  
                <th width="10%">incorp_date</th>  
                <th width="10%">gst_no</th>
                <th width="10%">city</th>
                <th width="10%">state</th>
                <th width="10%">f_name</th>
                <th width="10%">l_name</th>
                <th width="10%">status</th>
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
 }  
 ?> 