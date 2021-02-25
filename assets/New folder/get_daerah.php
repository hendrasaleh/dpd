<?php 
include 'koneksi.php';

$data = $_POST['data'];
$id = $_POST['id'];

?>
<?php 
if($data == "kabupaten"){
	?>
	Kabupaten/Kota
	<select id="form_kab">
		<option value="">Pilih Kabupaten/Kota</option>
		<?php 
		$daerah = mysqli_query($koneksi,"SELECT id, name FROM reg_regencies WHERE province_id ='$id' ORDER BY name");

		while($d = mysqli_fetch_array($daerah)){
			?>
			<option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
			<?php 
		}
		?>
	</select>

	<?php 
}else if($data == "kecamatan"){ 
	?>
	<select id="form_kec">
		<option value="">Pilih Kecamatan</option>
		<?php 
		$daerah = mysqli_query($koneksi,"SELECT id, name FROM reg_districts WHERE regency_id = '$id' ORDER BY name");

		while($d = mysqli_fetch_array($daerah)){
			?>
			<option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
			<?php 
		}
		?>
	</select>

	<?php 
}else if($data == "desa"){ 
	?>

	<select id="form_kel">
		<option value="">Pilih Desa</option>
		<?php 
		$daerah =mysqli_query($koneksi,"SELECT id, name FROM reg_villages WHERE district_id = '$id' ORDER BY name");
		while($d = mysqli_fetch_array($daerah)){
			?>
			<option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
			<?php 
		}
		?>
	</select>

	<?php 

}
?>