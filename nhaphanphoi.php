<?php include "lib\header.php" ?>
	<div style="margin-left: 15%">
	<article id="box">
		<table class="w3-table-all w3-hoverable">
			<?php echo "<h1>DANH SÁCH NHÀ PHÂN PHỐI</h1> <hr>" ?>
			<thead>
				<tr>
					<th>Mã nhà phân phối</th>
					<th>Tên nhà phân phối</th>
					<th>Email</th>
					<th>Địa chỉ</th>
					<th>Số điện thoại</th>
					<th>Thao tác</th>
				</tr>
				<?php 
				$sql="SELECT * FROM distributor";
				$query = $conn->query($sql);
				$dis=$query->fetchAll();
				foreach ($dis as $key => $value) {
					?>
						<tr>
								<th><?php echo $value['id'] ?></th>
								<th><?php echo $value['distributor_name'] ?></th>
								<th><?php echo $value['email'] ?></th>
								<th><?php echo $value['address'] ?></th>
								<th><?php echo $value['phone'] ?></th>
								<th style="text-align: center;"><a href="suancc.php?id=<?php echo $value['id'] ?>">Sửa</a> </th>
						</tr>
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