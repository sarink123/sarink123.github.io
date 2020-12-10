<?php include "lib\header.php" ?>
	<div style="margin-left: 20%">
		<article id="box">
            <table class="w3-table-all w3-hoverable">
                  <?php echo "<h1>DANH SÁCH PHIẾU XUẤT</h1> <hr>" ?> 
                  <a style="padding-left: 70% " href="nhappx.php" ><b>Tạo phiếu nhập xuất<br></b></a>
                  <thead>
                        <br>
                        <tr>
                              <th>Mã phiếu xuất</th>
                              <th>Tên nhân viên</th>
                              <th>Tên cửa hàng</th>
                              <th>Địa chỉ</th>
                              <th>Số điện thoại</th>
                              <th>Ngày tạo phiếu</th>
                              <th>Ngày cập nhật phiếu</th>
                              <th>Xem chi tiết</th>
                        </tr>
                        <?php 
                        $sql="SELECT * FROM export join users on users.id=user_id";
                        $query = $conn->query($sql);
                        $dis=$query->fetchAll();
                        foreach ($dis as $key => $value) {
                              ?>
                                    <tr>
                                          <th><?php echo $value['id_ex'] ?></th>
                                          <th><?php echo $value['fullname'] ?></th>
                                          <th><?php echo $value['retailer_name'] ?></th>
                                          <th><?php echo $value['address_ex'] ?></th>
                                          <th><?php echo $value['phone_ex'] ?></th>
                                          <th><?php echo date_format(new DateTime($value['createdate']),'d-m-Y') ?></th>
                                          <th><?php echo date_format(new DateTime($value['updatedate']),'d-m-Y') ?></th>
                                          <th><a href="thongtinpx.php?id=<?php echo $value['id_ex'] ?>">Chi tiết phiếu xuất</a> </th>
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

</body>
</html>