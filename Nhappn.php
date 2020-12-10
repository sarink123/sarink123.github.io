<?php include "lib\header.php" ?>
      
       <div style="margin-left: 15%">
            <form action="Nhappn.php" method="post">
            <table class="w3-table-all w3-hoverable"  >
              <tr><td colspan="2" style="text-align: center;"><h3>ĐIỀN THÔNG TIN PHIẾU NHẬP</h3></td></tr>
              <tr >
                <td>Mã phiếu nhập: </td>
                <td><input type="text" size="30" value="" name="mapn"></td>
              </tr>
              <tr >
                <td>Mã nhân viên lập phiếu: </td>
                <td><input type="text" size="30" value="<?php echo $_SESSION['id-us'] ;?>" name="nv" readonly></td>
                
              </tr>
              <tr >
                <td>email: </td>
                <td><input type="text" size="30" value="" name="email"></td>
              </tr>
              <tr >
                <td>Nhà cung cấp: </td>
                <td><input type="text" size="30" value="" name="ncc"></td>
                
              </tr>
              <tr >
                <td>Địa chỉ: </td>
                <td><input type="text" size="30" value="" name="dc"></td>
              </tr>
              <tr >
                <td>Số điện thoại: </td>
                <td><input type="text" size="30" value="" name="dt"></td>
              </tr>
              <tr >
                <td colspan="2" style="text-align: center" >
                  <input type="reset"  name="reset">
                  <input type="submit" name="them">
                </td>
              </tr>
              
            </table>
          </form>
        </div>
    <br>
    <?php include "lib/footer.php" ?>
  </body>
</html>