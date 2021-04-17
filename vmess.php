<?php
include "koneksi.php";
$id = $_GET['id'];
$query1 = mysqli_query($db,"SELECT * FROM vmess");
$query2 = mysqli_query($db,"SELECT * FROM user WHERE id=$id");
$data1 = mysqli_fetch_array($query1);
$data2 = mysqli_fetch_array($query2);
$satu = $data2['saldo'];
$dua = $data1['price'];

if ($satu < $dua) {
	echo "Saldo Kurang Silahkan hubungi admin". "<br>";
}else{
	if (isset($_POST['beli'])) {
		$id = $_POST['id'];
		$hasil = $satu - $dua;
		$sql = mysqli_query($db,"UPDATE user SET saldo='$hasil' WHERE id='$id'");
		// echo $hasil;
		//membuat metode redirect dengan kode 301
		header("location: vmess.php?id=$data2[id]", true, 301);
		//membuat kode di bawah header tidak diproses oleh website sehingga lebih aman
		exit();
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pengurangan saldo</title>
</head>
<body>
	Harga <?= $dua ?> <br>
	Saldo Anda : Rp.<?= $satu ?>
	<form method="POST">
		<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
		<button type="submit" name="beli">Beli</button>
	</form>
</body>
</html>