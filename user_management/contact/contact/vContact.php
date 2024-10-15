<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    #require_once "header.php"; 
 ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    
    <div style="text-align: center; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="../../masters/contact/cContact.php?action=contact-add"><img src="../../web/image/icon-add.png" />Add Contact</a>
    </div>
    <center>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Department Name</strong></th>
                    <th><strong>Code</strong></th>
                    <th><strong>Status</strong></th>                  
                </tr>
            </thead>
            <tbody>
                    <?php
                    if (! empty($result)) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {    
                    ?>
          <tr>                   
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["code"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    
                    <td><a class="btnEditAction"
                        href="../../masters/contact/cContact.php?action=contact-edit&id=<?php echo $row["id"]; ?>">
                        <img src="../../web/image/icon-edit.png" />
                        </a>
                        <a class="btnDeleteAction" 
                        href="../../masters/contact/cContact.php?action=contact-delete&id=<?php echo $row["id"]; ?>">
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
    </center>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script> 
</body>
</html>