<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <?php
  $eid=$_POST['edit_id5'];
  $sql="SELECT tblexpense.id,tblexpense.CategoryName,tblexpense.ProductName,tblexpense.PostingDate,tblexpense.ProductPrice,tblexpense.ProductAmount,tblexpense.ProductFood,tblexpense.ProductSalary,tblexpense.ProductDrugs from tblexpense  where tblexpense.id=:eid";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach($results as $row)
      {?>

        <h4 style="color: blue">View All Expenses Information</h4>
        <table border="1" class="table table-bordered">
          <tr>
            <th>Overhead</th>
            <td>
              <?php  echo $row->ProductName;?>
              </td>
          </tr>
          <tr>
            <th>Recurrent Expense</th>
            <td><?php  echo $row->CategoryName;?></td>
          </tr>
          <tr>
            <th>Food Expenses</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductAmount;?></td>
          </tr>
          <tr>
            <th>Salary Expenses</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductFood;?></td>
          </tr>
          <tr>
            <th>Accaride</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductSalary;?></td>
          </tr>
          <tr>
            <th>Other Expenses</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductPrice;?></td>
          </tr>
          <tr>
            <th>Posting Date</th>
            <td><?php  echo htmlentities(date("d-m-Y", strtotime($row->PostingDate)));?></td>
          </tr>
        </table> 
        <?php 
      }
    } ?>
  </div>