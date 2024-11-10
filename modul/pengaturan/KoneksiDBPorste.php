<?php
	$host = "localhost"; // atau IP server database
	$port = "5432"; // port default PostgreSQL
	$dbname = "SMPDB"; // ganti dengan nama database Anda
	$user = "postgres"; // ganti dengan nama pengguna Anda
	$password = "always!@#456"; // ganti dengan kata sandi pengguna Anda

	// Koneksi menggunakan PDO
	try {
	    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
	    $pdo = new PDO($dsn, $user, $password);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	    echo "Koneksi gagal: " . $e->getMessage();
	}
?>