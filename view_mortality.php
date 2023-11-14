<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <?php
  $eid=$_POST['edit_id5'];
  $sql="SELECT tblmortality.id,tblmortality.CategoryName,tblmortality.ProductName,tblmortality.PostingDate,tblmortality.ProductPrice,tblmortality.ProductAmount,tblmortality.ProductImage from tblmortality  where tblmortality.id=:eid";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach($results as $row)
      {?>

        <h4 style="color: blue">Dead Cow Information</h4>
        <table border="1" class="table table-bordered">
          <tr>
            <th>Death Reason</th>
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
            <th>Was it Treated?</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductAmount;?></td>
          </tr>
          <tr>
          <tr>
            <th>Treated By</th>
            <td><b></b>&nbsp;<?php  echo $row->ProductPrice;?></td>
          </tr>
            <th>Death Date</th>
            <td><?php  echo htmlentities(date("d-m-Y", strtotime($row->PostingDate)));?></td>
          </tr>
        </table> 
        <?php 
      }
    } ?>
  </div>