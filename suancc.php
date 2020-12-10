<?php include "lib/header.php"; ?>
<div style="margin-left: 15%">
	<article id="box">
		<table class="w3-table-all w3-hoverable">
			<?php echo "<h1>DANH SÁCH NHÀ PHÂN PHỐI</h1> <hr>" ?>
			<thead>
				<?php 
				$manpp=isset($_GET['id'])?$_GET['id']:'';
				$sql="SELECT * FROM distributor where id='$manpp'";
				$query = $conn->prepare($sql);
				$query->execute([$manpp]);

				$dis=$query->fetchAll(PDO::FETCH_ASSOC);
				foreach ($dis as $key => $value) {
					?>
					<form action="suancc.php" method="post">
						<tr>
							<th>Mã nhà phân phối</th>
							<th><input type="text" size="10" name="manpp" value="<?php echo $value['id'] ?>"></th>
						</tr>
						<tr>
							<th>Tên nhà phân phối</th>
							<th><input type="text" size="40" name="tennpp"  value="<?php echo $value['distributor_name'] ?>"></th>
						</tr>
						<tr>
							<th>Email</th>
							<th><input type="text" name="email" value="<?php echo $value['email'] ?>"></th>
						</tr>
						<tr>
							<th>Địa chỉ</th>
							<th><input type="text" size="55" name="diachi" value="<?php echo $value['address'] ?>"></th>
						</tr>
						<tr>
							<th>Số điện thoại</th>
							<th><input type="text" name="sdt" value="<?php echo $value['phone'] ?>"></th>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center">
								<input type="submit" name="capnhat" value="Cập nhật">
							</td>
						</tr>
						</form>
						<?php
					}	

				?>
				<?php
                                          if(isset($_POST['capnhat'])){
                                          
                                          $data=[
                                          $ma=postIndex('manpp'),
                                          $tennpp=postIndex('tennpp'),
                                          $email=postIndex('email'),
                                          $diachi=postIndex('diachi'),
                                          $sdt=postIndex('sdt')

                                          ];
                                          $sql2="UPDATE distributor set distributor_name='$tennpp',email='$email',address='$diachi',phone='$sdt' where id='$ma'";
                                          $stm=$conn->prepare($sql2);
                                          $stm->execute($data);

                                          echo '<script language="javascript">alert("Sửa thành công!"); window.location="nhaphanphoi.php";</script>';
                                          // var_dump($data);
                                          // exit;
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