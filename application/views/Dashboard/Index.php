<?php
$id = $this->session->userdata('user_id');
$id_groups = $this->ion_auth->get_users_groups($id)->row()->id;

?>
<!-- Default box -->
<div class="row">
  <h1><b>Selamat Datang</b></h1>
  <h2>Sistem Inventaris Barang Dinas Arsip Daerah Kota Cimahi | SIVENBA </h2>
</div>
<?php if ($id_groups != "6") : ?>
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Data User</span>
          <span class="info-box-number"><?= $count_users; ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
            Total User
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Data Supplier</span>
          <span class="info-box-number"><?= $count_supplier; ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
            Total Supplier
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Barang Masuk</span>
          <span class="info-box-number"><?= $count_barang_masuk; ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
            Total Barang Masuk
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Barang Keluar</span>
          <span class="info-box-number"><?= $count_barang_keluar; ?></span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
            Total Barang Keluar
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
<?php endif ?>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- ChartJS -->
<!-- <script src="<?= base_url(); ?>assets/bower_components/chart.js/Chart.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  const data = {
    labels: [
      'Barang Masuk',
      'Barang Keluar'
    ],
    datasets: [{
      label: 'My First Dataset',
      data: [<?= $count_barang_masuk; ?>, <?= $count_barang_keluar; ?>],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 205, 86)'
      ],
      hoverOffset: 4
    }],
    options: {
      responsive: true,
      legend: {
        position: 'bottom',
      },
    }
  };

  const config = {
    type: 'pie',
    data: data,
  };

  const ctx = document.getElementById('myChart').getContext('2d');
  window.myPie = new Chart(ctx, config);
</script>