<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['insert']))
{
    $eib= $_SESSION['editbid'];
    $category=$_POST['category'];
    $product=$_POST['product'];
    $price=$_POST['price'];
    $amount=$_POST['amount'];
    $drugs=$_POST['drugs'];
    $salary=$_POST['salary'];
    $food=$_POST['food'];
    $sql4="update tblexpense set CategoryName=:category,ProductName=:product,ProductPrice=:price,ProductAmount=:amount,ProductDrugs=:drugs,ProductSalary=:salary,ProductFood=:food where id=:eib";
    $query=$dbh->prepare($sql4);
    $query->bindParam(':category',$category,PDO::PARAM_STR);
    $query->bindParam(':product',$product,PDO::PARAM_STR);
    $query->bindParam(':price',$price,PDO::PARAM_STR);
    $query->bindParam(':amount',$amount,PDO::PARAM_STR);
    $query->bindParam(':drugs',$drugs,PDO::PARAM_STR);
    $query->bindParam(':salary',$salary,PDO::PARAM_STR);
    $query->bindParam(':food',$food,PDO::PARAM_STR);
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
    $sql2="SELECT tblexpense.id,tblexpense.CategoryName,tblexpense.ProductName,tblexpense.PostingDate,tblexpense.ProductPrice,tblexpense.ProductAmount,tblexpense.ProductFood,tblexpense.ProductSalary,tblexpense.ProductDrugs from tblexpense where tblexpense.id=:eid";
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
                    <div class="form-group col-md-12">
                        <label class="col-sm-12 pl-0 pr-0">Overhead</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="category" id="category" class="form-control" value="<?php  echo $row->CategoryName;?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-sm-12 pl-0 pr-0">Recurrent Expenses</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="product" id="category" class="form-control" value="<?php  echo $row->ProductName;?>" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-sm-12 pl-0 pr-0">Food</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="amount" value="<?php  echo $row->ProductAmount;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label class="col-sm-12 pl-0 pr-0">Drugs</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="drugs" value="<?php  echo $row->ProductDrugs;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label class="col-sm-12 pl-0 pr-0">Salary</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="food" value="<?php  echo $row->ProductFood;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label class="col-sm-12 pl-0 pr-0">Accaride</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="salary" value="<?php  echo $row->ProductSalary;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label class="col-sm-12 pl-0 pr-0">Other Expenses</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="price" value="<?php  echo $row->ProductPrice;?>" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="insert" class="btn btn-primary btn-fw mr-2" style="float: left;">Update</button>
            </form>
            <?php 
        }
    } ?>
</div>