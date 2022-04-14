<?php


$conn = mysqli_connect('localhost', 'root', 'root', 'db_api_pertashop') or die('tidak ada koneksi ke database');

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
