<?php include "lib\header.php" ?>
<div style="margin-left: 15%">
         <form  method="post" action="doimk.php">
          <table class="w3-table-all w3-hoverable">
            
   
            <tr>
              <td colspan="2" style="text-align: center;"><h2>Đổi mật khẩu</h2></td>
            </tr>
            <tr >
              <td>Password: </td>
              <td><input type="password" size="30" name="mkcu" ></td>
            </tr>
            
            <tr >
              <td>New password: </td>
              <td><input type="password" size="30" name="mkmoi"></td>
            </tr>
            
            <tr >
              <td>Comfirm new password: </td>
              <td><input type="password" size="30" name="mkmoi2"></td>
              
            </tr>
            
            <tr >
              <td colspan="2" style="text-align: center" >
                <input type="submit" value="Đổi mật khẩu" name="doimk">
              </td>
            </tr>
            
          </table>
        </form>
      </div>
      <br>
      <?php include "lib/footer.php" ?>
    </body>
  </html>