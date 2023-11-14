<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['insert']))
{
    $eib= $_SESSION['editbid'];
    $category=$_POST['category'];
    $code=$_POST['code'];
    $sex=$_POST['sex'];
    $calving=$_POST['calving'];
    $date=$_POST['date'];
    $dry=$_POST['dry'];
    $image=$_POST['image'];
    $serve=$_POST['serve'];
    $sql4="update tblheifers set CategoryName=:category,CategorySex=:sex,CategoryCalving=:calving,CategoryServe=:serve,CategoryDate=:date,ProductImage=:image,CategoryDry=:dry,CategoryCode=:code where id=:eib";
    $query=$dbh->prepare($sql4);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':code',$code,PDO::PARAM_STR);
    $query->bindParam(':sex',$sex,PDO::PARAM_STR);
    $query->bindParam(':dry',$dry,PDO::PARAM_STR);
    $query->bindParam(':serve',$serve,PDO::PARAM_STR);
    $query->bindParam(':date',$date,PDO::PARAM_STR);
    $query->bindParam(':calving',$calving,PDO::PARAM_STR);
    $query->bindParam(':image',$image,PDO::PARAM_STR);
    $query->bindParam(':eib',$eib,PDO::PARAM_STR);
    $query->execute();
    if ($query->execute())
    {
        echo '<script>alert("updated successfuly")</script>';
    }else{
        echo '<script>alert("update failed! try again later")</script>';
    }
}
?>
<div class="card-body">
    <?php
    $eid=$_POST['edit_id4'];
    $sql2="SELECT tblheifers.id,tblheifers.CategoryName,tblheifers.CategoryCode,tblheifers.CategorySex,tblheifers.CategoryDry,tblheifers.CategoryCalving,tblheifers.CategoryDate,tblheifers.CategorySex,tblheifers.CategoryServe,tblheifers.ProductImage,tblheifers.PostingDate from tblheifers  where tblheifers.id=:eid";
    $query2 = $dbh -> prepare($sql2);
    $query2-> bindParam(':eid', $eid, PDO::PARAM_STR);
    $query2->execute();
    $results=$query2->fetchAll(PDO::FETCH_OBJ);
    if($query2->rowCount() > 0)
    {
        foreach($results as $row)
        {
            $_SESSION['editbid']=$row->id;
            ?>
            <form class="form-sample"  method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-sm-12 pl-0 pr-0">Cow Name</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="category" id="category" class="form-control" value="<?php  echo $row->CategoryName;?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Cow Number</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="code" value="<?php  echo $row->CategoryCode;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Cow Sex</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="sex" value="<?php  echo $row->CategorySex;?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Cow A.I Serve</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="serve" value="<?php  echo $row->CategoryServe;?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Cow Dry</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="dry" value="<?php  echo $row->CategoryDry;?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Cow D.O.B or Date Of Buy</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="date" value="<?php  echo $row->CategoryDate;?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Cow Calving</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="calving" value="<?php  echo $row->CategoryCalving;?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label class="col-sm-12 pl-0 pr-0">Cow Image</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="image" value="<?php  echo $row->ProductImage;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <button type="submit" name="insert" class="btn btn-primary btn-fw mr-2" style="float: left;">Update</button>
            </form>
            <?php 
        }
    } ?>
</div>