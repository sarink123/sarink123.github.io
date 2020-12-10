<?php include "lib/header.php" ?>
<div style="margin-left: 15%">
	<article id="box">
		<table class="w3-table-all w3-hoverable">
			<?php echo "<h1>DANH SÁCH CỬA HÀNG</h1> <hr>" ?>
			<thead>
				<?php 
				$macn=isset($_GET['id'])?$_GET['id']:'';

				$sql="SELECT * FROM retailer where id=?";
				$query = $conn->prepare($sql);
				$query->execute([$macn]);

				$dis=$query->fetchAll(PDO::FETCH_ASSOC);
				foreach ($dis as $key => $value) {
					?>
					<form action="suacn.php" method="post">
						<tr>
							<th>Mã chi nhánh</th>
							<th><input type="text" name="ma" size="10" value="<?php echo $value['id'] ?>" readonly ></th>
						</tr>
						<tr>
							<th>Tên cửa hàng</th>
							<th><input type="text" name="tencn" size="30" value="<?php echo $value['name'] ?>"></th>
						</tr>
						<tr>
							<th>Email</th>
							<th><input type="text" name="email" size="30" value="<?php echo $value['email'] ?>"></th>
						</tr>
						<tr>
							<th>Địa chỉ</th>
							<th><input type="text" name="diachi" size="40" value="<?php echo $value['address'] ?>"></th>
						</tr>
						<tr>
							<th>Số điện thoại</th>
							<th><input type="text" name="sdt" value="<?php echo $value['phone'] ?>"></th>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center"><input type="submit" name="capnhat" value="Cập nhật"></td>
						</tr>
						</form>
						<?php
					}	

				?>
				<?php
                                          if(isset($_POST['capnhat'])){
                                          
                                          $data=[
                                          $macn=postIndex('ma'),
                                          $tencn=postIndex('tencn'),
                                          $email=postIndex('email'),
                                          $diachi=postIndex('diachi'),
                                          $sdt=postIndex('sdt')

                                          ];
                                          $sql2="UPDATE retailer set name='$tencn',email='$email',address='$diachi',phone='$sdt' where id='$macn'";
                                          $stm=$conn->prepare($sql2);
                                          $stm->execute($data);

                                          echo '<script language="javascript">alert("Sửa thành công!"); window.location="chinhanh.php";</script>';
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