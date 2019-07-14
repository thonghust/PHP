		<?php
	require_once("connect.php");
	require_once("ham.php");
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Nạp Tiền</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<table border="1" cellpadding="5" align="center" width="500px">
<tr>
	<td>Số điện thoại</td>
    <td><input type="text" name="sdt" value="<?php echo $_SESSION['sdt']; ?>"></td>
    <td align="center"><input type="submit" name="danhba" value="Danh bạ"><input type="submit" name="change" value="Đổi mã xác nhận"></td>
</tr>
<tr>
	<td>Số tiền</td>
    <td colspan="2">
    <select name="st">
    <?php
		$q = mysqli_query($con, "select * from menhgia");
		while($num = mysqli_fetch_array($q))
		{ ?>
			<option><?php echo $num['tien']; ?></option>
		<?php } ?>
    </select>
    </td>
</tr>
<tr>
	<td>Hãng thẻ cào</td>
    <td colspan="2">
    <?php
		$q = mysqli_query($con, "select * from hang");
		while($num = mysqli_fetch_array($q))
		{ ?>
    <input type="radio" name="hang" value="<?php echo $num['tenhang']; ?>"><?php echo $num['tenhang']; ?> <br><?php } ?>
    </td>
</tr>
<tr>
	<td>Mã xác nhận</td>
    <td><input type="text" name="code" width="180px"></td>
    <td align="center"><img src="random.php"></td>
</tr>
<tr>
	<td colspan="3" align="center"><input type="submit" name="ok" value="Nạp tiền"><input type="submit" name="kt" value="Kiểm tra TK"><input type="submit" name="home" value="Trang chủ"></td>
</tr>
</table>
</form>
</body>
</html>
<?php
	if(isset($_POST['ok']))
	{
		$sdt = $_POST['sdt'];
		$st = $_POST['st'];
		$ma = $_POST['code'];
		if(empty($sdt))
		{
			echo "<script>alert('Bạn chưa nhập SĐT')</script>";
		}
		if(empty($_POST['hang']))
		{
			echo "<script>alert('Hãy chọn hãng thẻ cào')</script>";
		}
		if(empty($_POST['code']))
		{
			echo "<script>alert('Mã xác nhận không được để trống')</script>";
		}
		else if(($_POST['hang']=="Viettel" || $_POST['hang']=="viettel") && substr($sdt,0,3)!=="097")
		{
			echo "<script>alert('Số điện thoại không đúng với đầu số nhà mạng Viettel, phải bắt đầu bằng 097')</script>";
		}
		else if(($_POST['hang']=="Vinaphone" || $_POST['hang']=="vinaphone") && substr($sdt,0,3)!=="091")
		{
			echo "<script>alert('Số điện thoại không đúng với đầu số nhà mạng Vinaphone, phải bắt đầu bằng 091')</script>";
		}
		else if(($_POST['hang']=="Mobiphone" || $_POST['hang']=="mobiphone") && substr($sdt,0,3)!=="093")
		{
			echo "<script>alert('Số điện thoại không đúng với đầu số nhà mạng Mobiphone, phải bắt đầu bằng 093')</script>";
		}
		else if($_POST['code'] != $_SESSION['security_code'])
		{
			echo "<script>alert('Mã xác nhận không đúng')</script>";
		}
		else if(check($sdt)==0)
		{
			$them = them($sdt, $st, $_POST['hang'], $ma);
			if($them) echo "<script> alert('Thêm thành công') </script>";
			else echo "<script> alert('Thêm không thành công') </script>";
		}
		else
		{
			$capnhat = capnhat($sdt, $st);
			if($capnhat) echo "<script> alert('Cập nhật thành công') </script>";
			else echo "<script> alert('Cập nhật không thành công') </script>";
		}
	}
	if(isset($_POST['kt']))
	{
		header('location:kiemtra.php');
	}
	if(isset($_POST['change']))
	{
		header('location:bai1.php');
	}
	if(isset($_POST['home']))
	{
		header('location:home.php');
	}
	if(isset($_POST['danhba']))
	{
		header('location:danhba.php');
	}
?>