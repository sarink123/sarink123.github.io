<?php include "lib\header.php" ?>
	<div style="margin-left: 15%">
	<article id="box">
		<table class="w3-table-all w3-hoverable">
			<?php echo "<h1>TỒN KHO</h1> <hr>" ?>
			<thead>
				<tr>
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Loại vải </th>
					<th>Số Lượng</th>
					<th>Đơn giá</th>
					<th>Tên nhà phân phối</th>
				</tr>
				<?php 
				$sql="SELECT * FROM goods join type on type_id=type join distributor on distributor.id=distributor_id";
				$query = $conn->query($sql);
				$dis=$query->fetchAll();
				foreach ($dis as $key => $value) {
					?>
						<tr>
								<th><?php echo $value['id_goods'] ?></th>
								<th><?php echo $value['name'] ?></th>
								<th><?php echo $value['type_name'] ?></th>
								<th><?php echo $value['amount'] ?></th>
								<th><?php echo $value['price'] ?></th>
								<th><?php echo $value['distributor_name'] ?></th>
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