<?php include "lib\header.php" ?>
	<div style="margin-left: 15%">
	<article id="box">
		<table class="w3-table-all w3-hoverable">
			<?php echo "<h1>DANH SÁCH NHÂN VIÊN</h1> <hr>" ?>
			<thead>
				<tr>
					<th>Mã nhân viên</th>
					<th>Tên nhân viên</th>
					<th>Email</th>
					<th>Ngày sinh</th>
					<th>thao tác </th>
				</tr>
				<?php 
				$sql="SELECT * FROM users where admin=0";
				$query = $conn->query($sql);
				$dis=$query->fetchAll();
				foreach ($dis as $key => $value) {
					?>
						<tr>
								<th><?php echo $value['id'] ?></th>
								<th><?php echo $value['fullname'] ?></th>
								<th><?php echo $value['email'] ?></th>
								<th><?php echo date_format(new Datetime($value['birthday']),'Y-m-d') ?></th>
								<th><a href="suanv.php?id=<?php echo $value['id'] ?>">Sửa thông tin</a></th>
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