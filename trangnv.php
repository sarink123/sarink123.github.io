<?php include "lib\header.php" ?>
		<div style="margin-left: 15%">
			<article id="box">		
				<?php if(isset($_GET['search'])){
					
				
				include "lib\search.php";
		
		} 
				else{
					?>
						<table class="w3-table-all w3-hoverable">
							<?php echo "<h2>Sản phẩm</h2> <hr>"; ?>
					<thead>
						<tr>
							<th>Mã sản phẩm</th>
							<th>Tên sản phẩm</th>
							<th>Số Lượng</th>
							<th>Tên nhà cung cấp</th>
						</tr>
						<?php
						$sql="SELECT * FROM goods join distributor on distributor_id=distributor.id LIMIT 5";
						$query = $conn->query($sql);
						$dis=$query->fetchAll();
						foreach ($dis as $key => $value) {
						?>
						<tr>
							<th><?php echo $value['id'] ?></th>
							<th><?php echo $value['name'] ?></th>
							<th><?php echo $value['amount'] ?></th>
							<th><?php echo $value['distributor_name'] ?></th>
						</tr>
						<?php
						}

						?>
					</thead>
				</table>
				<a href="sanpham.php" >Xem thêm...</a>
			<hr>
				<table class="w3-table-all w3-hoverable">
					<?php echo "<br><h2>Nhà cung cấp</h2> <hr>"; ?>
					<thead>
						<tr>
							<th>Mã số</th>
							<th>Nhà cung cấp</th>
							<th>Địa chỉ</th>
						</tr>
						<?php
						$sql="SELECT * FROM distributor LIMIT 5";
						$query = $conn->query($sql);
						$dis=$query->fetchAll();
						foreach ($dis as $key => $value) {
						?>
						<tr>
							<th><?php echo $value['id'] ?></th>
							<th><?php echo $value['distributor_name'] ?></th>
							<th><?php echo $value['address'] ?></th>
						</tr>
						<?php
						}
						?>
					</thead>
				</table>
				<a href="nhaphanphoi.php" >Xem thêm...</a>
			<hr>
				<table class="w3-table-all w3-hoverable">
					<?php echo "<br><h2>Cửa hàng</h2> <hr>"; ?>
					<thead>
						<tr>
							<th>Cửa hàng</th>
							<th>số điện thoại</th>
							<th>Địa chỉ</th>
						</tr>
						<?php
						$sql="SELECT * FROM retailer LIMIT 5";
						$query = $conn->query($sql);
						$dis=$query->fetchAll();
						foreach ($dis as $key => $value) {
						?>
						<tr>
							<th><?php echo $value['id'] ?></th>
							<th><?php echo $value['name'] ?></th>
							<th><?php echo $value['address'] ?></th>
						</tr>
						<?php
						}
						?>
					
				</thead>
			</table>
			<a href="chinhanh.php" >Xem thêm...</a>
					<?php
				}

				?>
				</thead>
			</table>
			</article>
		</div>
		<br>
		<?php include "lib/footer.php" ?>
	</body>
</html>