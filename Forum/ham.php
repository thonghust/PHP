<?php
	require_once("connect.php");
	function comment($cmt, $tk, $idbaiviet, $idtk)
	{
		global $con;
		$q = mysqli_query($con, "insert into comment(comment, taikhoan, idbaiviet, id_tk) values('$cmt', '$tk', '$idbaiviet', '$idtk')");
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
	function thembaiviet($ten, $nd, $nguoi, $topic, $idtopic, $anh)
	{
		global $con;
		$q = mysqli_query($con, "seclect * from timkiem where tenbaiviet = '$ten'");
		if($q) echo "<script>alert('Bài viết này đã được tạo, hãy chọn 1 bài viết không trùng tên với bài đã có')</script>";
		else
		{
			$q1 = mysqli_query($con, "insert into timkiem(tenbaiviet, noidung, nguoitao, topic, idtopic, anh) values('$ten', '$nd', '$nguoi', '$topic', '$idtopic', '$anh')");
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
	function suabai($id, $tenbai, $nd, $anh)
	{
		global $con;
		$q = mysqli_query($con, "update timkiem set tenbaiviet = '$tenbai', noidung = '$nd', anh = '$anh' where id = $id");
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
		if($q) echo "<script>alert('Sửa Topic thành công')</script>";
		else echo "<script>alert('Sửa Topic không thành công')</script>";
	}
?>