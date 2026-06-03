<?php
  ini_set('memory_limit', '512M');
  require("config/config.default.php");
  require("config/config.function.php");

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  try {

      $token = $_GET['token'] ?? 'false';

      $querys = mysqli_query(
          $koneksi,
          "SELECT token_api FROM setting WHERE token_api='$token'"
      );

      $cektoken = mysqli_num_rows($querys);

      if ($cektoken == 0) {
          throw new Exception("Token tidak valid");
      }

      $querybank = mysqli_query($koneksi, "select * from mapel ");
      $array_bank = array();
      while ($bank = mysqli_fetch_assoc($querybank)) {
        $array_bank[] = $bank;
      }
      $querysoal = mysqli_query($koneksi, "select * from soal ");
      $array_soal = array();
      while ($soalx = mysqli_fetch_assoc($querysoal)) {
        $array_soal[] = $soalx;
      }
      $queryjadwal = mysqli_query($koneksi, "select * from ujian");
      $array_jadwal = array();
      while ($jadwal = mysqli_fetch_assoc($queryjadwal)) {
        $array_jadwal[] = $jadwal;
      }
      $queryfile = mysqli_query($koneksi, "select * from file_pendukung");
      $array_file = array();
      while ($file = mysqli_fetch_assoc($queryfile)) {
        $array_file[] = $file;
      }
      
      echo json_encode(
          [
            "bank" => $array_bank,
            "soal" => $array_soal,
            "jadwal" => $array_jadwal,
            "file" => $array_file
          ]
      );

  } catch (Exception $e) {

      header('Content-Type: application/json');

      echo json_encode([
          'status' => false,
          'message' => $e->getMessage()
      ]);
  }
