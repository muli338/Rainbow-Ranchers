<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <?php
  $eid=$_POST['edit_id5'];
  $sql="SELECT tblserved.id,tblserved.CategoryName,tblserved.ProductName,tblserved.PostingDate,tblserved.ProductPrice,tblserved.ProductAmount,tblserved.ProductSales,tblserved.ProductCalving,tblserved.ProductImage from tblserved  where tblserved.id=:eid";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach($results as $row)
      {?>

        <h4 style="color: blue">View Served Cows Category Information</h4>
        <table border="1" class="table table-bordered">
          <tr>
            <th>Born or Bought</th>
            <td>
              <img src="productimages/<?php  echo $row->ProductImage;?>" class="mr-2" alt="image">
              <?php  echo $row->ProductName;?>
              </td>
          </tr>
          <tr>
            <th>Cow Name</th>
            <td><?php  echo $row->CategoryName;?></td>
          </tr>
          <tr>
            <th>Trans in/Out</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductAmount;?></td>
          </tr>
          <tr>
            <th>Saverage</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductSales;?></td>
          </tr>
          <tr>
            <th>Sales</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductPrice;?></td>
          </tr>
          <tr>
            <th>Mortal off</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductCalving;?></td>
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