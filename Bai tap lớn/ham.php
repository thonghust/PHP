<?php
	require_once("connect.php");
	function comment($cmt, $tk, $idbaiviet)
	{
		global $con;
		$q = mysqli_query($con, "insert into comment(comment, taikhoan, idbaiviet) values('$cmt', '$tk', '$idbaiviet')");
		if($q) echo "<script>alert('Bình luận thành công')</script>";
		else echo "<script>alert('Bình luận không thành công')</script>";
	}
	function dangky($tk, $mk)
	{
		global $con;
		$q = mysqli_query($con, "select * from taikhoan where taikhoan = '$tk'");
		if(mysqli_num_rows($q))
		{
			echo "<script>alert('Tên tài khoản này đã tồn tại')</script>";
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
		else echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác')</script>";
	}
	function thembaiviet($ten, $nd, $nguoi, $topic, $idtopic, $anh, $bai, $time, $anhchinh)
	{
		global $con;
		$q = mysqli_query($con, "seclect * from timkiem where tenbaiviet = '$ten'");
		if($q) echo "<script>alert('Bài viết này đã được tạo, hãy chọn 1 bài viết không trùng tên với bài đã có')</script>";
		else
		{
			$q1 = mysqli_query($con, "insert into timkiem(tenbaiviet, noidung, nguoitao, topic, idtopic, anh, time, anhchinh) values('$ten', '$nd', '$nguoi', '$topic', '$idtopic', '$anh', '$time', '$anhchinh')");
			$q2 = mysqli_query($con, "update topic set bai = bai + 1 where id = '$idtopic'");
			if($q1) echo "<script>alert('Thêm bài viết thành công')</script>";
			else echo "<script>alert('Thêm bài viết không thành công')</script>";
		}
	}
	function themtopic($nd)
	{
		global $con;
		$q = mysqli_query($con, "select * from topic where topic = '$nd'");
		if(mysqli_num_rows($q)) echo "<script>alert('Topic này đã được tạo, hãy chọn 1 topic không trùng tên với topic đã có')</script>";
		else
		{
			$q1 = mysqli_query($con, "insert into topic(topic) values('$nd')");
			if($q1) echo "<script>alert('Thêm topic thành công')</script>";
			else echo "<script>alert('Thêm topic không thành công')</script>";
		}
	}
	function suabai($id, $tenbai, $nd, $anh, $anhchinh)
	{
		global $con;
		$q = mysqli_query($con, "update timkiem set tenbaiviet = '$tenbai', noidung = '$nd', anh = '$anh', anhchinh = '$anhchinh' where id = $id");
		if($q)
		{
			echo "<script>alert('Sửa bài viết thành công')</script>";
		}
		else echo "<script>alert('Sửa bài viết không thành công')</script>";
	}
	function suabl($id, $cmt)
	{
		global $con;
		$q = mysqli_query($con, "update comment set comment = '$cmt' where id = $id");
	}
	function suatopic($id, $topic)
	{
		global $con;
		$q = mysqli_query($con, "update topic set topic = '$topic' where id = $id");
		$k = mysqli_query($con, "update timkiem set topic = '$topic' where idtopic = $id");
		if($q) echo "<script>alert('Sửa Topic thành công')</script>";
		else echo "<script>alert('Sửa Topic không thành công')</script>";
	}
	function suataikhoan($id, $tk, $mk)
	{
		global $con;
		$q = mysqli_query($con, "update taikhoan set taikhoan = '$tk', matkhau = '$mk' where id = $id");
		if($q) echo "<script>alert('Sửa tài khoản thành công')</script>";
		else echo "<script>alert('Sửa tài khoản không thành công')</script>";
	}
	function timkiem($key)
	{
		global $con;
		$q = mysqli_query($con, "select * from timkiem where tenbaiviet like '%$tukhoa%' or noidung like '%$tukhoa%'");
	}
	function dembai($id)
	{
		global $con;
		$q1 = mysqli_query($con, "select * from topic where id = $id");
		$num = mysqli_fetch_array($q1);
		$idcd = $num['id'];
		$q2 = mysqli_query($con, "select * from timkiem where idtopic = '$idcd'");
		$q3 = mysqli_num_rows($q2);
		echo $q3;
	}
?>