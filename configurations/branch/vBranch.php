<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    #require_once "header.php"; 
 ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    
    
    
    <div id="toys-grid" class="container">
    <center><h2>Branch Masters</h2></center>
    <table id="datatableid" class="table table-bordered table-dark" >
    <thead style="background-color:#002060;">
               <tr>
               <div style="text-align: right; margin: 20px 0px 10px;">
                  <a id="btnAddAction" href="../../masters/branch/cBranch.php?action=branch-add"><img src="../../web/image/icon-add.png" />Add Contact</a>
               </div>
               </tr>
                <tr>
                    <th><strong>First Name</strong></th>
                    <th><strong>Last Name</strong></th>
                    <th><strong>Date of Birth</strong></th>
                    <th><strong>Email</strong></th> 
                    <th><strong>Mobile</strong></th>
                    <th><strong>Reference1</strong></th>
                    <th><strong>Reference2</strong></th>    
                    <th><strong>Actions</strong></th>                  
                </tr>
            </thead>
            <tbody style="background-color:#ffffff; color: #000000;">
                    <?php
                    if (! empty($result)) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {    
                    ?>
          <tr>                   
                    <td><?php echo $row["f_name"]; ?></td>
                    <td><?php echo $row["l_code"]; ?></td>
                    <td><?php echo $row["dob"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["mobile"]; ?></td>
                    <td><?php echo $row["add_ref1"]; ?></td>
                    <td><?php echo $row["add_ref2"]; ?></td>
                    
                    <td><a class="btnEditAction"
                        href="../../masters/branch/cBranch.php?action=branch-edit&id=<?php echo $row["id"]; ?>">
                        <img src="../../web/image/icon-edit.png" />
                        </a>
                        <a class="btnDeleteAction" 
                        href="../../masters/branch/cBranch.php?action=contact-delete&id=<?php echo $row["id"]; ?>">
                        <img src="../../web/image/icon-delete.png" />
                        </a>
                    </td>
                </tr>
                    <?php
                        
                        }
                    }
                    ?>
            <tbody>        
        </table>
    </div>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script> 
</body>
</html>