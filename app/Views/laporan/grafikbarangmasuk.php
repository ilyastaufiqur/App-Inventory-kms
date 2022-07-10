<link rel="stylesheet" href="<?= base_url() . '/plugins/chart.js/Chart.min.css' ?>">
<script src="<?= base_url() . '/plugins/chart.js/Chart.bundle.min.js' ?>"></script>

<canvas id="myChart" style="height: 50vh; width:80vh ;"></canvas>
<?php
$tanggal = "";
$total = "";

foreach ($grafik as $row) {
  $tgl = $row->tgl;
  $tanggal .= "'$tgl'" . ",";

  $totalHarga = $row->totalharga;
  $total .= "'$totalHarga'" . ",";
}
?>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    responsive: true,
    data: {
      labels: [<?= $tanggal; ?>],
      datasets: [{
        label: 'Total Harga',
        backgroundColor: ['rgb(255,99,232)', 'rgb(15,99,135)', 'rgb(15,99,135)', 'rgb(150,99,135)', 'rgb(159,99,135)', 'rgb(178,99,135)', 'rgb(171,99,135)'],
        borderColor: ['rgb(265,992,130)'],
        data: [<?= $total; ?>]
      }]
    },
    duration: 1000
  });
</script>