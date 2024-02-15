<?php

function formatRupiah($nomial, $prefix = false)
{
  if ($prefix != null) {
    return "Rp. " . number_format($nomial, 0, ',', '.');
  } else {
    return  number_format($nomial, 0, ',', '.');
  }
}

function ubahAngkaToBulan($bulanAngka)
{
  $bulanArray = [
    '0' => '',
    '1' => 'Januari',
    '2' => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
  ];
  return $bulanArray[$bulanAngka + 0];
}
