<?php include "lib\header.php" ?>
	<div style="margin-left: 20%">
		<article id="box">
            <table class="w3-table-all w3-hoverable">
                  <?php echo "<h1>DANH SÁCH PHIẾU NHẬP</h1> <hr>" ?> 
                  <a style="padding-left: 70% " href="Nhappn.php" ><b>Tạo phiếu nhập hàng<br></b></a>
                  <thead>
                        <br>
                        <tr>
                              <th>Mã phiếu nhập</th>
                              <th>Tên nhân viên</th>
                              <th>Tên nhà cung cấp</th>
                              <th>Địa chỉ</th>
                              <th>Số điện thoại</th>
                              <th>Ngày tạo phiếu</th>
                              <th>Ngày cập nhật phiếu</th>
                              <th>Xem chi tiết</th>
                              
                        </tr>
                        <?php 
                        $sql="SELECT * FROM import join users on users.id=user_id";
                        $query = $conn->query($sql);
                        $dis=$query->fetchAll();
                        foreach ($dis as $key => $value) {
                              ?>
                                    <tr>
                                          <th><?php echo $value['id_im'] ?></th>
                                          <th><?php echo $value['fullname'] ?></th>
                                          <th><?php echo $value['distributor_name'] ?></th>
                                          <th><?php echo $value['address_im'] ?></th>
                                          <th><?php echo $value['phone_im'] ?></th>
                                          <th><?php echo date_format(new DateTime($value['createdate']),'d-m-Y') ?></th>
                                          <th><?php echo date_format(new DateTime($value['updatedate']),'d-m-Y') ?></th>
                                          <th><a href="thongtinpn.php?id=<?php echo $value['id_im'] ?>">Chi tiết phiếu nhập</a> </th>
                                    </tr>
                                    <?php
                              }     

                        ?>
                  </thead>
            </table>
            
      </article>
</div>
	</div>
	
	<?php include "lib/footer.php" ?>
</div>
</body>
</html>