<?php include "lib\header.php" ?>
					<div style="margin-left: 15%">
					<form  method="post">
					<table class="w3-table-all w3-hoverable">

                  			<?php
                  			$ma=isset($_GET['id'])?$_GET['id']:'';
          							$sql="SELECT * FROM importdetails WHERE import_id='$ma'";
          							$stm=$conn->prepare($sql);
          							$stm->execute();
                        ?>
                        <tr>      
                          <td colspan="2" style="text-align: center;"><h2>Chi tiết phiếu nhập thứ <?php echo $ma ; ?></h2></td>
                      </tr>
                      <?php
          							$rows=$stm->fetchAll(PDO::FETCH_ASSOC);
                  			foreach ($rows as $key => $value) {	
                  				?>
              				<tr >
                  				<td>Mã phiếu nhập: </td>
                  				<td><input type="text" size="30" value="<?php echo $value['import_id'] ?>" name="maph" readonly></td>
                  			</tr>
                  			<tr >
                  				<td>Mã hàng: </td>
                  				<td><input type="text" size="30" value="<?php echo $value['good_id'] ?>" name="mah" readonly></td>
                  			</tr>
                  			<tr >
                  				<td>Tên hàng: </td>
                  				<td><input type="text" size="30" value="<?php echo $value['goods_name'] ?>" name="tenh" readonly></td>
                  			</tr>
            
                  			<tr >
                  				<td>Số lượng: </td>
                  				<td><input type="text" size="30" placeholder="0" value="<?php echo $value['amount']?>" name="sl"></td>
                  				
                  			</tr>
                  			<tr >
                  				<td>Đơn vị tính: </td>
                  				<td><input type="text" size="30" placeholder="0" value="<?php echo $value['unit'] ?>" name="dv"></td>
                  			</tr>

                  			<tr >
                  				<td>Đơn giá: </td>
                  				<td><input type="text" size="30" placeholder="0vnđ" value="<?php echo $value['price'] ?>" name="gia"></td>
                  			</tr>
                  			<tr>
                  				<td>Loại: </td>
                  				<td>
                  					<select name="loai">
                  						<option value="<?php echo $value['type'] ?>"><?php echo $value['type'] ?></option>
                  						<?php
                  							$query=$conn->query("SELECT * FROM type");
          											$query->execute();
          											$data=$query->fetchAll(PDO::FETCH_ASSOC);
                  							foreach ($data as $key => $value) { 
                  								?>
                  								<option value="<?php echo $value['type_id'] ?>">
                  									<?php echo $value['type_name'] ?>
                  									</option>
                  							<?php
                  						}
                  						?>
                  					</select>
                  				</td>
                  			</tr>
                  			<tr><td colspan="2"><hr></td></tr>
                  			
                  			<?php

                  		}
                  		?>      
                  	</table>		
	</form>
</div>

		<br>
					<?php include "lib/footer.php" ?>
				</body>
			</html>
