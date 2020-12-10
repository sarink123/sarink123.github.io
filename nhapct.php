<?php include "lib/header.php" ?>

  
      <div style="margin-left: 15%">
         <form  method="post" action="nhapct.php">
          <table class="w3-table-all w3-hoverable">
            
   
            <?php
            $ma=isset($_SESSION['id'])?$_SESSION['id']:'';

            ?>
            <tr>
              <td colspan="2" style="text-align: center;"><h2>Chi tiết phiếu nhập <?php echo $ma ?></h2></td>
            </tr>
            <tr >
              <td>Mã phiếu nhập: </td>
              <td><input type="text" size="30" name="maph" value="<?php echo $ma ?>" readonly></td>
            </tr>
            
            <tr >
              <td>Tên hàng: </td>
              <td><input type="text" size="30" name="tenh"></td>
            </tr>
            
            <tr >
              <td>Số lượng: </td>
              <td><input type="text" size="30" placeholder="0" name="sl"></td>
              
            </tr>
            <tr >
              <td>Đơn vị tính: </td>
              <td><input type="text" size="30" value="Mét"  name="dv" readonly></td>
            </tr>
            <tr >
              <td>Đơn giá: </td>
              <td><input type="text" size="30" placeholder="0" name="gia"></td>
            </tr>
            <tr>
              <td>Loại: </td>
              <td>
                <select name="loai">
                  <option value="">
                  Chọn loại sản phẩm </option>
                  <?php
                    $query=$conn->query("SELECT * FROM type");
                            $query->execute();
                            $data=$query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $key => $value) {
                  ?>
                  <option value="<?php echo $value['type_id']?>">
                    <?php echo $value['type_name'] ?>
                  </option>
                  <?php
                  }
                  ?>
                </select>
              </td>
            </tr>
            
            <tr >
              <td colspan="2" style="text-align: center" >
                <input type="submit" value="Thêm" name="themct">
                <button ><a href="thongtinpn.php?id=<?php echo $ma ?>" >Kết thúc</a></button>
              </td>
            </tr>
            
          </table>
        </form>
      </div>
      <br>
      <?php include "lib/footer.php" ?>
    </body>
  </html>

  <!-- Tiến hành thêm -->
 <?php

  if (isset($_POST['themct'])) {


    // receive all input values from the form
    $ncc=$_SESSION['ncc'];
    $loai=postIndex('loai');
    $id = postIndex('maph');
    $tenh = postIndex('tenh');
    $sl=postIndex('sl');
    $dv = postIndex('dv');
    $gia=postIndex('gia');
    $loai=postIndex('loai');
     //Lấy mã nhà cung cấp
    $query2=$conn->query("SELECT * FROM distributor where email='$ncc'" );
    $data2=$query2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data2 as $key => $value) {
      $disid=$value['id'];
      break;
    }
    //Lấy tên loại
    $query3=$conn->query("SELECT type_name FROM type WHERE type_id='$loai'");
    $query3->execute();
    $type=$query3->fetchAll(PDO::FETCH_ASSOC);
    foreach ($type as $key => $value) {
      $typename=$value['type_name'];
      break;
    }
    //Lấy danh sách sản phẩm
    $query1=$conn->query("SELECT * FROM goods join type on type_id=type WHERE distributor_id='$disid' and name ='$tenh'" );
    $data=$query1->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($data);
    // print_r($tenh);
    // print_r($disid);
    //   exit;
   if(!empty($data)){
      foreach ($data as $key => $value) {
       $mancc=$value['distributor_id'];
       $name=$value['name'];
       $good_id=$value['id_goods'];
       $hang=$value['name'];
       $giah=$value['price'];
       $tenloai=$value['type_name'];
       $dvh=$value['unit'];
       break;
      }
     
    //   //Nếu đã có sp có cùng tên cùng ncc sẽ tiến hành thêm chi tiết phiếu luôn 
    //   else{
              if ($sl=='0'){
                echo '<script language="javascript">alert("Vui lòng điền số lượng nhập"); window.location="nhapct.php";</script>';
                exit;
              }
              $sql2="INSERT INTO importdetails (import_id,good_id,goods_name,amount,price,type,unit) VALUES ('$id','$good_id','$hang','$sl','$giah','$tenloai','$dvh') ";
              $query=$conn->prepare($sql2);

              if($query->execute()){
              $sqlup="UPDATE goods SET amount=amount+$sl where id_goods='$good_id'";
              $stm2=$conn->prepare($sqlup);
              if($stm2->execute()){
              echo '<script language="javascript">alert("tiếp tục thêm sản phẩm"); window.location="nhapct.php";</script>';
                exit;
              }

              }
            
      //}
    }
   else{
              //Kiểm tra xem tên 
              if ($tenh==""||$sl==""||$gia==""||$loai=="")
            {
            echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin để cập nhật sản phẩm mới!"); window.location="nhapct.php";</script>';
            exit;
            }

            $sql="INSERT INTO goods (name,amount,price,distributor_id,type,unit) VALUES ('$tenh','$sl','$gia','$disid','$loai','$dv') ";
            $dis=$conn->prepare($sql);
             
            //Thực thi lệnh thêm sản phẩm mới
            if($dis->execute())
            {
              //Tìm mã sản phẩm 
            $sqlfind=$conn->query("SELECT id_goods FROM goods WHERE distributor_id='$disid' and name='$tenh'");
            $kq=$sqlfind->fetchAll(PDO::FETCH_ASSOC);
            foreach ($kq as $key => $value) {
              $good_id=$value['id_goods'];
              break;
            }
              $sql2="INSERT INTO importdetails (import_id,good_id,goods_name,amount,price,type,unit) VALUES ('$id','$good_id','$tenh','$sl','$gia','$typename','$dv')";
              $query=$conn->prepare($sql2);
              if($query->execute()){

                  $sqlup="UPDATE goods SET amount=amount+$sl where id_goods='$good_id'";
                  $stm2=$conn->prepare($sqlup);
                  if($stm2->execute()){
                  echo '<script language="javascript">alert("tiếp tục thêm sản phẩm"); window.location="nhapct.php";</script>';
                  exit;
                  }
              } 
            }
            }
         }


  
  ?>