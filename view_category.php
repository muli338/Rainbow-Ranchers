<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <h3><?php  echo $_POST['edit_id'];?></h3>
  <?php
  $eid=$_POST['edit_id5'];
  $sql="SELECT tblcategory.id,tblcategory.CategoryName,tblcategory.CategoryCode,tblcategory.CategoryBreed,tblcategory.CategorySire,tblcategory.CategoryServe,tblcategory.CategorySex,tblcategory.CategoryDry,tblcategory.CategoryCalving,tblcategory.CategoryDate,tblcategory.ProductImage,tblcategory.PostingDate from tblcategory  where tblcategory.id=:eid";
  $query = $dbh -> prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    foreach($results as $row)
      {?>

        <h4 style="color: blue">Cow Information</h4>
        <table border="1" class="table table-bordered">
          <tr>
            <th>Cow Name</th>
            <td><?php  echo $row->CategoryName;?></td>
          </tr>
          <tr>
            <th>Cow Number</th>
            <td><?php  echo $row->CategoryCode;?></td>
          </tr>
          <tr>
            <th>Cow Sire</th>
            <td><?php  echo $row->CategoryBreed;?></td>
          </tr>
          <tr>
            <th>Cow Breed</th>
            <td><?php  echo $row->CategorySire;?></td>
          </tr>
          <tr>
            <th>Cow Serve</th>
            <td><?php  echo $row->CategoryServe;?></td>
          </tr>
          <tr>
          <tr>
            <th>Cow D.O.B or Date of Buy</th>
            <td><?php  echo $row->CategoryDate;?></td>
          </tr>
          <tr>
            <th>Cow Sex</th>
            <td><?php  echo $row->CategorySex;?></td>
          </tr>
          <tr>
            <th>Cow Dry</th>
            <td><?php  echo $row->CategoryDry;?></td>
          </tr>
          <tr>
            <th>Cow Calving Expected</th>
            <td><?php  echo $row->CategoryCalving;?></td>
          </tr>
          <tr>
            <th>Cow Image</th>
            <td><?php  echo $row->ProductImage;?></td>
          </tr>
            <th>Posting Date</th>
            <td><?php  echo $row->PostingDate;?></td>
          </tr>
        </table> 
        <?php 
      }
    } ?>
  </div>