<?php include "lib/header.php" ?>

  
     <div style="margin-left: 15%">
         <form  method="post" action="nhapctpx.php">
          <table class="w3-table-all w3-hoverable">
            
   
            <?php
            $ma=isset($_SESSION['id'])?$_SESSION['id']:'';

            ?>
            <tr>
              <td colspan="2" style="text-align: center;"><h2>Chi tiết phiếu nhập <?php echo $ma ?></h2></td>
            </tr>
            <tr >
              <td>Mã phiếu nhập: </td>
              <td><input type="text" size="30" name="mapx" value="<?php echo $ma ?>" readonly></td>
            </tr>
            
            <tr >
              <td>Tên hàng: </td>
              <td> <select name="tenh">
                  <option value="">
                  Chọn sản phẩm </option>
                  <?php
                    $query=$conn->query("SELECT * FROM goods join distributor on distributor_id=distributor.id");
                            $query->execute();
                            $data=$query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $key => $value) {
                  ?>
                  <option value="<?php echo $value['id_goods']?>">
                    <?php echo $value['name'] ?>-<?php echo $value['distributor_name'] ?>
                  </option>
                  <?php
                  }
                  ?>
                </select></td>
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
              <td colspan="2" style="text-align: center" >
                <input type="submit" value="Thêm" name="themctpx">
                <button ><a href="thongtinpx.php?id=<?php echo $ma ?>" >Kết thúc</a></button>
              </td>
            </tr>
            
          </table>
        </form>
      </div>
      <br>
      <?php include "lib/footer.php" ?>
    </body>
  </html>
 <?php

  if (isset($_POST['themctpx'])) {


    // receive all input values from the form
    $ch=$_SESSION['ch'];
    $id = postIndex('mapx');
    $loai = postIndex('tenh');
    $sl=postIndex('sl');
    $dv = postIndex('dv');
    //$gia=postIndex('gia');
    //$loai=postIndex('loai');
     //Lấy mã nhà cung cấp
    $query2=$conn->query("SELECT * FROM retailer where email='$ch'" );
    $data2=$query2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data2 as $key => $value) {
      $disid=$value['id'];
      break;
    }
    
    //
    //Kiểm tra xem điền đủ thông tin kh?
   
    //Lấy danh sách s   
    if ($sl==""||$loai=="")
    {
    echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin để xuất hàng"); window.location="nhapctpx.php";</script>';
    exit;
    }
    $query1=$conn->query("SELECT * FROM goods join type on type_id=type WHERE id_goods ='$loai' " );
    $data=$query1->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($data);
    // exit;
   if(!empty($data)){
      foreach ($data as $key => $value) {
       $name=$value['name'];
       $good_id=$value['id_goods'];
       $hang=$value['name'];
       $giah=$value['price'];
       $tenloai=$value['type_name'];
       $dvh=$value['unit'];
       $slkho=$value['amount'];
       break;
      }
      // var_dump($data);
      // var_dump($mancc);
      // exit;
      // 
      //Nếu mã nhà cung cấp khác hay tên sp khác sẽ tiến hành thêm sp mới
      if($slkho>$sl){
              $sql2="INSERT INTO exportdetails (export_id,good_id,good_name,amount,price,type,unit) VALUES ('$id','$good_id','$name','$sl','$giah','$tenloai','$dv')";
              $query=$conn->prepare($sql2);
              if($query->execute()){

              $sqlup="UPDATE goods SET amount=amount-$sl where id_goods='$good_id'";
              $stm2=$conn->prepare($sqlup);
              if($stm2->execute()){
              echo '<script language="javascript">alert("Tiếp tục lấy sản phẩm!"); window.location="nhapctpx.php";</script>';
              exit;
              }
            } 
            }
      //Nếu đã có sp có cùng tên cùng ncc sẽ tiến hành thêm chi tiết phiếu luôn 
      else{
             
              echo '<script language="javascript">alert("Sản phẩm không đủ để xuất! "); window.location="nhapctpx.php";</script>';
            exit;
            
      }
    }
   else{
            echo '<script language="javascript">alert("Không có sản phẩm này"); window.location="nhapctpx.php";</script>';
            exit;
             
            }
         }


  
  ?>