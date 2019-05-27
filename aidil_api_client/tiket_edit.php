<?php
//Curl untuk tambah data via api
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://localhost/aidil_api/api/tiket/ubah",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $_POST,
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		),
	));
	$response_tambah = curl_exec($curl);
	$err = curl_error($curl);
	$response_tambah = json_decode($response_tambah, true);
	if(isset($response_tambah['code']) == 200){
		echo "<script type=\"text/javascript\">alert('Data Berhasil diubah...!!');window.location.href=\"http://localhost/aidil_api_client/tiket.php\";</script>";
	}else{
		echo $response_tambah['data'];
	}
} 
//Curl untuk menghapus data dari api

//Curl untuk mengambil detail data makul dari ednpoint api
if(isset($_GET['id'])){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://localhost/aidil_api/api/tiket?id=$_GET[id]",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "cache-control: no-cache"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	$response = json_decode($response, true);
	if(isset($response['data'])){ 
		foreach ($response['data'] as $value); ?>
		<h3>Tambah Data Kos</h3>
		<form class="form-horizontal" method="POST" action="http://localhost/aidil_api_client/tiket_edit.php">
			<input type="hidden" name="id" value="<?php echo $value['id']; ?>"/>
			Nama pesawat* <br/>
			<input type="text" placeholder="Nama pesawat" name="nama_pesawat" value="<?php echo $value['nama_pesawat']; ?>" required/><br/>
			Harga tiket* <br/>
			<input type="text" placeholder="Harga tiket" name="harga_tiket" value="<?php echo $value['harga_tiket']; ?>" required/><br/>
			Jumlah persediaan * <br/>
			<input type="text" placeholder="Jumlah persediaan " name="jumlah_persediaan" value="<?php echo $value['jumlah_persediaan']; ?>" required/><br/>
			<button type="submit" type="button">
				Submit
			</button>
		</form> <?php
	}
}else{
	echo "Data tidak dikenali";
} ?>