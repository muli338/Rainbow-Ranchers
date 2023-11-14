<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['save']))
{
  
  $category=$_POST['category'];
  $code=$_POST['code'];
  $sire=$_POST['breed'];
  $breed=$_POST['sire'];
  $sex=$_POST['sex'];
  $dry=$_POST['dry'];
  $calving=$_POST['calving'];
  $date=$_POST['date'];
  $image=$_FILES["productimage"]["name"];
  move_uploaded_file($_FILES["productimage"]["tmp_name"],"productimages/".$_FILES["productimage"]["name"]);
  $serve=$_POST['serve'];
  $sql="insert into tblheifers(CategoryName,CategoryCode,CategoryBreed,CategorySire,CategorySex,CategoryDry,CategoryCalving,CategoryDate,ProductImage,CategoryServe)values(:category,:code,:sire,:breed,:serve,:dry,:calving,:date,:image,:sex)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':category',$category,PDO::PARAM_STR);
  $query->bindParam(':code',$code,PDO::PARAM_STR);
  $query->bindParam(':breed',$sire,PDO::PARAM_STR);
  $query->bindParam(':sire',$breed,PDO::PARAM_STR);
  $query->bindParam(':serve',$sex,PDO::PARAM_STR);
  $query->bindParam(':dry',$dry,PDO::PARAM_STR);
  $query->bindParam(':calving',$calving,PDO::PARAM_STR);
  $query->bindParam(':date',$date,PDO::PARAM_STR);
  $query->bindParam(':sex',$serve,PDO::PARAM_STR);
  $query->bindParam(':image',$image,PDO::PARAM_STR);
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) 
  {
    echo '<script>alert("Registered successfully")</script>';
    echo "<script>window.location.href ='product1.php'</script>";
  }
  else
  {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}
if(isset($_GET['del'])){    
  $cmpid=$_GET['del'];
  $query=mysqli_query($con,"delete from tblheifers where id='$cmpid'");
  echo "<script>alert('Category record deleted.');</script>";   
  echo "<script>window.location.href='product1.php'</script>";
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
                <h5 class="modal-title" style="float: left;">Cow register</h5>
              </div>
              <div class="col-md-12 mt-4">
                <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Cow Name</label>
                      <input type="text" name="category" class="form-control" value="" id="category" placeholder="Enter Cow Name" required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Cow number</label>
                      <input type="text" name="code" value="" placeholder="Enter Cow Number" class="form-control" id="code"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Sire</label>
                      <input type="text" name="sire" value="" placeholder="Enter Sire" class="form-control" id="sire"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Breed</label>
                      <input type="text" name="breed" value="" placeholder="Enter breed" class="form-control" id="breed"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Sex</label>
                      <input type="text" name="sex" value="" placeholder="Enter cow sex" class="form-control" id="sex"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">D.O.B or Date of Buy</label>
                      <input type="text" name="date" value="" placeholder="Enter Sire" class="form-control" id="date"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">A.I serve</label>
                      <input type="text" name="serve" value="" placeholder="Enter A.I serve" class="form-control" id="serve"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Dry</label>
                      <input type="text" name="dry" value="" placeholder="Enter Dry" class="form-control" id="dry"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Calving expected</label>
                      <input type="text" name="calving" value="" placeholder="Enter Calving expected" class="form-control" id="calving"required>
                    </div>
                  </div>
                  <div class="form-group col-md-6 pl-md-0">
                      <label class="col-sm-12 pl-0 pr-0 ">Attach Product Photo</label>
                      <div class="col-sm-12 pl-0 pr-0">
                        <input type="file" name="productimage" class="file-upload-default">
                        <div class="input-group ">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" style="" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                    </div> 
                  <button type="submit" style="float: left;" name="save" class="btn btn-primary mr-2 mb-4">Save</button>
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
                      <h5 class="modal-title">Edit Cow details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update4">
                      <?php @include("edit_heifers.php");?>
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
                      <h5 class="modal-title">View cow details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update5">
                      <?php @include("view_heifers.php");?>
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
                      <th>Cow Name</th>
                      <th class="text-center">Cow Number</th>
                      <th class="text-center">Cow  Breed</th>
                      <th class="text-center">Cow Sire</th>
                      <th class="text-center">Cow Sex</th>
                      <th class="text-center">Cow D.O.B/Date Of Buy</th>
                      <th class="text-center">AI.serve</th>
                      <th class="text-center">Cow Dry</th>
                      <th class="text-center">Calving Expected Date</th>
                      <th class="text-center">Cow Image</th>
                      <th class="text-center">Posting Date</th>
                      <th class=" Text-center" style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql="SELECT tblheifers.id,tblheifers.CategoryName,tblheifers.CategoryCode,tblheifers.CategorySire,tblheifers.CategoryBreed,tblheifers.CategorySex,tblheifers.CategoryDate,tblheifers.CategoryServe,tblheifers.CategoryDry,tblheifers.CategoryCalving,tblheifers.ProductImage,tblheifers.PostingDate from tblheifers ORDER BY id DESC";
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
                          <td class=""><a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php  echo htmlentities($row->CategoryName);?></a></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryCode);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryBreed);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategorySire);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategorySex);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryDate);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryServe);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryDry);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryCalving);?></td>
                          <td>
                            <img src="productimages/<?php  echo $row->ProductImage;?>" class="mr-2" alt="image"><a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php  echo htmlentities($row->ProductName);?></a>
                          </td>
                          <td class="text-center"><?php  echo htmlentities($row->PostingDate);?></td>
                          <td class=" text-center"><a href="#"  class=" edit_data4" id="<?php echo  ($row->id); ?>" title="click to edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>
                            <a href="#"  class=" edit_data5" id="<?php echo  ($row->id); ?>" title="click to view">&nbsp;<i class="mdi mdi-eye" aria-hidden="true"></i></a>
                            <a href="product1.php?del=<?php echo $row->id;?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"> <i class="mdi mdi-delete"></i> </a>
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
        url:"edit_heifers.php",
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
        url:"view_heifers.php",
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