<!DOCTYPE html>
<html>
<head>
	<title>Menampilkan Data Daerah - www.malasngoding.com</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
</head>
<body>
	<?php 
	include 'koneksi.php';
	?>

	<style type="text/css">
		body{
			font-family: "Roboto";
		}
	</style>

	<h2>Data Daerah Indonesia Dengan PHP, MySQLi & Ajax <br> <a href="https://www.malasngoding.com/menampilkan-data-daerah-indonesia-php-mysqli-ajax">www.malasngoding.com</a></h2>
	<form method="post" action="proses.php">
	<select name="prov" id="form_prov">
		<option value="">Pilih Provinsi</option>
		<?php 
		$daerah = mysqli_query($koneksi,"SELECT id, name FROM reg_provinces ORDER BY name");
		while($d = mysqli_fetch_array($daerah)){
			?>
			<option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
			<?php 
		}
		?>
	</select>

	<select name="kab" id="form_kab"></select>

	<select name="kec" id="form_kec"></select>

	<select name="kel" id="form_des"></select>
	<button type="submit">Proses</button>
	</form>

	<script type="text/javascript">
		$(document).ready(function(){

			// sembunyikan form kabupaten, kecamatan dan desa
			$("#form_kab").hide();
			$("#form_kec").hide();
			$("#form_des").hide();

			// ambil data kabupaten ketika data memilih provinsi
			$('body').on("change","#form_prov",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=kabupaten";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_kab").html(hasil);
						$("#form_kab").show();
						$("#form_kec").hide();
						$("#form_des").hide();
					}
				});
			});

			// ambil data kecamatan/kota ketika data memilih kabupaten
			$('body').on("change","#form_kab",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=kecamatan";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_kec").html(hasil);
						$("#form_kec").show();
						$("#form_des").hide();
					}
				});
			});

			// ambil data desa ketika data memilih kecamatan/kota
			$('body').on("change","#form_kec",function(){
				var id = $(this).val();
				var data = "id="+id+"&data=desa";
				$.ajax({
					type: 'POST',
					url: "get_daerah.php",
					data: data,
					success: function(hasil) {
						$("#form_des").html(hasil);
						$("#form_des").show();
					}
				});
			});


		});
	</script>
</body>
</html>