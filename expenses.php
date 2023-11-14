<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['save']))
{
  $category=$_POST['category'];
  $product=$_POST['product'];
  $price=$_POST['price'];
  $amount=$_POST['amount'];
  $salary=$_POST['salary'];
  $drugs=$_POST['drugs'];
  $food=$_POST['food'];
  $sql="insert into tblexpense(CategoryName,ProductName,ProductPrice,ProductAmount,ProductFood,ProductSalary,ProductDrugs)values(:category,:product,:price,:amount,:salary,:food,:drugs)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':category',$category,PDO::PARAM_STR);
  $query->bindParam(':product',$product,PDO::PARAM_STR);
  $query->bindParam(':price',$price,PDO::PARAM_STR);
  $query->bindParam(':amount',$amount,PDO::PARAM_STR);
  $query->bindParam(':drugs',$drugs,PDO::PARAM_STR);
  $query->bindParam(':food',$food,PDO::PARAM_STR);
  $query->bindParam(':salary',$salary,PDO::PARAM_STR);
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) 
  {
    echo '<script>alert("Registered successfully")</script>';
    echo "<script>window.location.href ='expenses.php'</script>";
  }
  else
  {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}
if(isset($_GET['del'])){    
  $cmpid=$_GET['del'];
  $query=mysqli_query($con,"delete from tblexpense where id='$cmpid'");
  echo "<script>alert('Product record deleted.');</script>";   
  echo "<script>window.location.href='expenses.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php @include("includes/header.php");?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php @include("includes/sidebar.php");?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
               <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Record Farm Expenses</h5>
              </div>
              <div class="col-md-12 mt-4">
                <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row ">
                  <div class="form-group col-md-6">
                      <label for="exampleInputName1">Overhead </label>
                      <input type="text" name="category" class="form-control" value="" id="product" placeholder="Enter Overhead" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Recurrent Expenses </label>
                      <input type="text" name="product" class="form-control" value="" id="product" placeholder="Enter Recurrent Expenses" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Food Expenses </label>
                      <input type="text" name="amount" class="form-control" value="" id="amount" placeholder="Enter Food Expenses" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Drugs Expenses </label>
                      <input type="text" name="drugs" class="form-control" value="" id="amount" placeholder="Enter Drug Expenses" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Salary Expenses </label>
                      <input type="text" name="salary" class="form-control" value="" id="amount" placeholder="Enter salary expenses" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Accaride </label>
                      <input type="text" name="food" class="form-control" value="" id="amount" placeholder="Enter accaride" required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Other Expenses</label>
                      <input type="text" name="price" value="" placeholder="Enter Other Expenses" class="form-control" id="price"required>
                    </div>
                  </div>
                  <button type="submit" style="float: left;" name="save" class="btn btn-primary  mr-2 mb-4">Save</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <!--  start  modal -->
              <div id="editData4" class="modal fade">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Expenses details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update4">
                      <?php @include("edit_expenses.php");?>
                    </div>
                    <div class="modal-footer ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </div>
              <!--   end modal -->
              <!--  start  modal -->
              <div id="editData5" class="modal fade">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View Expenses details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update5">
                      <?php @include("view_expenses.php");?>
                    </div>
                    <div class="modal-footer ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </div>
              <!--   end modal -->
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Overhead</th>
                      <th class="text-center"> Recurrent Expenses </th>
                      <th class="text-center"> Food Expenses</th>
                      <th class="text-center"> Drugs</th>
                      <th class="text-center">Salary Expenses</th>
                      <th class="text-center"> Accaride</th>
                      <th class="text-center"> Other Expenses</th>
                      <th class="text-center">Posting Date</th>
                      <th class=" Text-center" style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql="SELECT tblexpense.id,tblexpense.CategoryName,tblexpense.ProductName,tblexpense.PostingDate,tblexpense.ProductPrice,tblexpense.ProductAmount,tblexpense.ProductSalary,tblexpense.ProductDrugs,tblexpense.ProductFood from tblexpense ORDER BY id DESC";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                      { 
                        ?>
                        <tr>
                          <td class="text-center"><?php echo htmlentities($cnt);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryName);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->ProductName);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->ProductAmount);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->ProductDrugs);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->ProductFood);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->ProductSalary);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->ProductPrice);?></td>
                          <td class="text-center"><?php  echo htmlentities(date("d-m-Y", strtotime($row->PostingDate)));?></td>
                          <td class=" text-center"><a href="#"  class=" edit_data4" id="<?php echo  ($row->id); ?>" title="click to edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>
                            <a href="#"  class=" edit_data5" id="<?php echo  ($row->id); ?>" title="click to view">&nbsp;<i class="mdi mdi-eye" aria-hidden="true"></i></a>
                            <a href="expenses.php?del=<?php echo ($row->id);?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"> <i class="mdi mdi-delete"></i> </a>
                          </td>
                        </tr>
                        <?php 
                        $cnt=$cnt+1;
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      <?php @include("includes/footer.php");?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<?php @include("includes/foot.php");?>
<!-- End custom js for this page -->
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data4',function(){
      var edit_id4=$(this).attr('id');
      $.ajax({
        url:"edit_expenses.php",
        type:"post",
        data:{edit_id4:edit_id4},
        success:function(data){
          $("#info_update4").html(data);
          $("#editData4").modal('show');
        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data5',function(){
      var edit_id5=$(this).attr('id');
      $.ajax({
        url:"view_expenses.php",
        type:"post",
        data:{edit_id5:edit_id5},
        success:function(data){
          $("#info_update5").html(data);
          $("#editData5").modal('show');
        }
      });
    });
  });
</script>

</body>
</html>