<?php include "lib\header.php" ?>
      <div style="margin-left: 15%">
        <article id="box">
          <form action="suanv.php" method="post">
          <table class="w3-table-all w3-hoverable" align="center">
            <?php echo "<h1>Thông Tin Cá Nhân</h1> <hr>" ?>
            <thead>
              <br>
                <?php
                $ma=isset($_GET['id'])?$_GET['id']:'';
                  $sql="SELECT * from users where id='$ma'";
                  $stm=$conn->query($sql);
                  $rows=$stm->fetchAll();

                  foreach ($rows as $key => $value) {
                    ?>
            <tr>
                <th>Mã Nhân viên:</th>
                <td><input type="text" size="40" value="<?php echo $value['id'] ?>" name="ma" readonly></td>
            </tr>
            <tr>
              <th>Tên tài khoản:</th>
              <td><input type="text" size="40" value="<?php echo $value['username'] ?>" readonly></td>
            </tr>
            <tr>
              <th>Email:</th>
              <td><input type="text" size="40" value="<?php echo $value['email'] ?> " name="email"></td>
            </tr>
            <tr>
              <th>Tên nhân viên:</th>
              <td><input type="text" size="40" value="<?php echo $value['fullname'] ?>" name="ten"></td>
            </tr>
            <tr>
              <th>Ngày sinh:</th>
              <td><input type="text" size="40" value="<?php echo date_format(new Datetime($value['birthday']),'Y-m-d') ?>" name="ns">* Year- Month- Day</td>
            </tr>
            <tr>
              <th>Số điện thoại: </th>
              <td><input type="text" size="40" value="<?php echo number_format($value['phone']) ?>" name="sdt"></td>
            </tr>
            <tr>
              <th>Địa chỉ: </th>
              <td><input type="text" size="40" value="<?php echo $value['address'] ?>" name="dc"></td>
            </tr>
            <tr>
              <td style="text-align: center" colspan="2">
                <input type="submit" value="Lưu"  name="cn">
              </td>
            </tr>
            
            <?php
                  }
                ?>

            </table>
          </thead>
          </article>
        </div>
      </div>
   
       <?php
          if(isset($_POST['cn'])){
                
            //$ngaysinh=date("Y-m-d H:i:s",strtotime(postIndex('ns')));
            $ma=postIndex('ma');
            $mail=postIndex('email');
            $tennv=postIndex('ten');
            $ngaysinh=postIndex('ns');
            $sdt=postIndex('sdt');
            $dc=postIndex('dc');

            if($sdt!=''){
            $sql2="UPDATE users set email='$mail',fullname='$tennv', birthday='$ngaysinh',phone='$sdt',address='$dc',updatedate='$date' where id='$ma'";
          }
          else{
             $sql2="UPDATE users set email='$mail',fullname='$tennv', birthday='$ngaysinh',address='$dc',updatedate='$date' where id='$ma'";
          }
            $stm=$conn->prepare($sql2);
            $stm->execute();
            echo '<script language="javascript">alert("Sửa thành công!"); window.location="nhanvien.php";</script>';

          }
          ?>

     <?php include "lib/footer.php" ?>
    </div>
  </body>
</html>