<?php
	require_once("connect.php");
	function check($sdt)
	{
		global $con;
		$q = mysqli_query($con, "select * from thongtin where sdt = '$sdt'");
		if(mysqli_num_rows($q)) return 1; else return 0;
	}
	function them($sdt, $st, $hang, $ma)
	{
		global $con;
		$q = mysqli_query($con, "insert into thongtin(sdt, sotien, hang, ma) values('$sdt', '$st', '$hang', '$ma')");
		if($q) return 1; else return 0;
	}
	function capnhat($sdt, $st)
	{
		global $con;
		$q = mysqli_query($con, "update thongtin set sotien = sotien + '$st' where sdt = '$sdt'");
		if($q) return 1; else return 0;
	}
	function kiemtra($sdt)
	{
		global $con;
		$q = mysqli_query($con, "select * from thongtin where sdt = '$sdt'");
		$num = mysqli_fetch_array($q);
		if($num)
		{
			echo "Số điện thoại của bạn là: ".$num['sdt']."<br>";
			echo "Số tiền trong tài khoản là: ".$num['sotien']."";
		}
		else
		echo "<script> alert('Không tìm thấy số điện thoại') </script>";
	}
	function themdb($ten, $sdt)
	{
		global $con;
		$q1 = mysqli_query($con, "select * from danhba where sdt = '$sdt'");
		$q2 = mysqli_query($con, "select *from danhba where ten = '$ten'");
		if(mysqli_num_rows($q1))
		{
			echo "<script>alert('Số điện thoại đã có')</script>";
		}
		if(mysqli_num_rows($q2))
		{
			echo "<script>alert('Tên người dùng đã tồn tại')</script>";
		}
		if(mysqli_num_rows($q1)==0 && mysqli_num_rows($q2)==0)
		{
			$q3 = mysqli_query($con, "insert into danhba(ten, sdt) values('$ten', '$sdt')");
			if($q3) return 1; else return 0;
		}
	}
	function suadb($id, $ten, $sdt)
	{
		global $con;
		$q = mysqli_query($con, "update danhba set ten = '$ten', sdt = '$sdt' where id = $id");
		if($q) return 1; else return 0;
	}
	function themmenhgia($tien)
	{
		global $con;
		$q = mysqli_query($con, "select * from menhgia where tien = '$tien'");
		if(mysqli_num_rows($q))
		{
			echo "<script>alert('Mệnh giá thẻ này đã tồn tại')</script>";
		}
		else
		{
			$q1 = mysqli_query($con, "insert into menhgia(tien) values('$tien')");
			if($q1) return 1; else return 0;
		}
	}
	function suamenhgia($id, $tien)
	{
		global $con;
		$q = mysqli_query($con, "update menhgia set tien = '$tien' where id = $id");
		if($q) return 1; else return 0;
	}
	function themhang($hang)
	{
		global $con;
		$q = mysqli_query($con, "select * from hang where tenhang = '$hang'");
		if(mysqli_num_rows($q))
		{
			echo "<script>alert('Hãng thẻ đã tồn tại')</script>";
		}
		else
		{
			$q1 = mysqli_query($con, "insert into hang(tenhang) values('$hang')");
			if($q1) return 1; else return 0;
		}
	}
	function suahangthe($id, $hang)
	{
		global $con;
		$q = mysqli_query($con, "update hang set tenhang = '$hang' where id = $id");
		if($q) return 1; else return 0;
	}
	function dangky($tk, $mk)
	{
		global $con;
		$q = mysqli_query($con, "select * from taikhoan where taikhoan = '$tk'");
		if(mysqli_num_rows($q))
		{
			echo "<script>alert('Tên tài khoản đã tồn tại')</script>";
		}
		else
		{
			$q1 = mysqli_query($con, "insert into taikhoan(taikhoan, matkhau) values('$tk', '$mk')");
			if($q1) echo "<script>alert('Chúc mừng bạn đã đăng ký thành công')</script>";
			else echo "<script>alert('Đăng ký không thành công')</script>";
		}
	}
	function dangnhap($tk, $mk)
	{
		global $con;
		$q = mysqli_query($con, "select * from taikhoan where taikhoan = '$tk' and matkhau = '$mk'");
		if(mysqli_num_rows($q))
		{
			echo "<script>alert('Đăng nhập thành công')</script>";
			header('location:home.php');
		}
		else
		{
			echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu')</script>";
		}
	}
?>