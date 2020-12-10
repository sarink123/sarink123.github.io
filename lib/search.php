<table class="w3-table-all w3-hoverable">
					<thead>
<?php
					$tk=addslashes(isset($_GET['tt'])?$_GET['tt']:'');
					echo "<h1>KẾT QUẢ TÌM KIẾM </h1> <hr>";
					if($tk!=''){
					
					 $query1 = "SELECT * FROM import join users on users.id=user_id WHERE user_id like '%$tk%' or id_im like '%$tk%' or user_id like '%$tk%' or distributor_name like '%$tk%'or fullname like '%$tk%'";
					 $query2="SELECT * FROM export join users on users.id=user_id WHERE user_id like '%$tk%' or id_ex like '%$tk%' or retailer_id like '%$tk%' or retailer_name like '%$tk%'or fullname like '%$tk%'";
					 $stm=$conn->prepare($query1);
					 $stm2=$conn->prepare($query2);
					  $stm->execute();
					   $rows=$stm->fetchAll(PDO::FETCH_ASSOC);
					   ?>
					   	<tr>
							<th>Mã phiếu </th>
							<th>Tên nhân viên</th>
							<th>Tên nhà cung cấp</th>
							<th>Ngày tạo phiếu</th>
							<th>Ngày cập nhật phiếu</th>
							<th>Thông tin chi tiết</th>
							
						</tr>
					   <?php
					   foreach ($rows as $key => $value) {
					   	
					   	?>
					   	
					   	<tr>
					   		
							<th><?php echo $value['id_im'] ?></th>
							<th><?php echo $value['fullname'] ?></th>
							<th><?php echo $value['distributor_name'] ?></th>
							<th><?php echo date_format(new DateTime($value['createdate']),'d-m-Y') ?></th>
							<th><?php echo date_format(new DateTime($value['updatedate']),'d-m-Y') ?></th>
							<th><a href="thongtinpn.php?id=<?php echo $value['id_im'] ?>">Chi tiết phiếu nhập</a> </th>
						</tr>
						
						<?php
				}
			
			    $stm2->execute();
				$rows2=$stm2->fetchAll(PDO::FETCH_ASSOC);
				
				?><hr><br>
				<!-- 	<tr>
							<th>Mã phiếu xuất</th>
							<th>Tên nhân viên</th>
							<th>Tên cửa hàng</th>
							<th>Ngày tạo phiếu</th>
							<th>Ngày cập nhật phiếu</th>
							<th>Thông tin chi tiết</th>
						</tr> -->
				<?php
				foreach ($rows2 as $key => $value) {

					   	?>
					   	<tr>
							<th><?php echo $value['id_ex'] ?></th>
							<th><?php echo $value['fullname'] ?></th>
							<th><?php echo $value['retailer_name'] ?></th>
							<th><?php echo date_format(new DateTime($value['createdate']),'d-m-Y') ?></th>
							<th><?php echo date_format(new DateTime($value['updatedate']),'d-m-Y') ?></th>
							<th><a href="thongtin.php?<?php echo $value['id'] ?>">Chi tiết phiếu xuất</a> </th>
						</tr>
						<?php
			}
		}
		else{
			echo "<h1>Vui lòng điền từ khóa!!</h1>";
		}