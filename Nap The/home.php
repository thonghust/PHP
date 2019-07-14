<?php
require_once("connect.php");
session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Trang Chủ</title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<table align="center" border="1" width="300px" cellpadding="5">
			<tr align="center">
				<td colspan="3"><font style="font-family:Tahoma, Geneva, sans-serif; font-weight:bold">Trang quản trị</font></td>
			</tr>
			<tr align="center">
				<td colspan="2"><?php echo "Xin chào, " .$_SESSION['tk']. " ";
				echo "["." <a href=\"dangxuat.php\">Đăng xuất</a>"."]"; ?>
			</td>
		</tr>
		<tr align="center">
			<td><input type="submit" name="nap" value="Nạp tiền tài khoản"><input type="submit" name="kt" value="Kiểm tra tài khoản"></td>
			<td><input type="submit" name="danhba" value="Quản lý danh bạ"><input type="submit" name="hang" value="Quản lý hãng thẻ"><input type="submit" name="menhgia" value="Quản lý mệnh giá"></td>
		</tr>
		<tr align="center">
			<td><input type="submit" name="thongke" value="Thống kê tiền"><input type="submit" name="tktk" value="Thống kê tài khoản"></td>
			<td><input type="submit" name="dx" value="Đăng xuất"></td>
		</tr>
	</table></form>
</body>
</html>
<?php
if(isset($_POST['nap']))
{
	header('location:bai1.php');
}
if(isset($_POST['kt']))
{
	header('location:kiemtra.php');
}
if(isset($_POST['danhba']))
{
	header('location:danhba.php');
}
if(isset($_POST['menhgia']))
{
	header('location:menhgia.php');
}
if(isset($_POST['hang']))
{
	header('location:hangthe.php');
}
if(isset($_POST['thongke']))
{
	header('location:thongke.php');
}
if(isset($_POST['dx']))
{
	header('location:dangxuat.php');
}
if(isset($_POST['tktk']))
{
	header('location:tktk.php');
}
?>