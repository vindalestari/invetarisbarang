<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Laporan Barang Masuk</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>

      <div class="box-body">
        <div class="row" style="margin-bottom: 10px">

          <div class="col-md-8 text-center">
            <div style="margin-top: 8px" id="message">

            </div>
          </div>
          <div class="col-md-1 text-right">
          </div>
          <div class="col-md-3 text-right">
            <form action="<?php echo site_url($search_page); ?>" class="form-inline" method="get" style="margin-top:10px">
              <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                  <?php
                  if ($q <> '') {
                  ?>
                    <a href="<?php echo site_url('laporan'); ?>" class="btn btn-default">Reset</a>
                  <?php
                  }
                  ?>
                  <button class="btn btn-primary" type="submit">Search</button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <div style="margin-bottom: 10px;margin-left:10px;margin-top:60px"><label for="filter">Filter Tanggal:</label></div>
        <div class="row" style="margin-bottom: 10px;margin-left:10px">
          <form action="<?php echo base_url('laporan/laporan_barang_masuk'); ?>" class="form-inline" method="post">
            <div class="col input-group">
              <!-- <label><b>Filter :</b></label> -->
              <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-calendar"></i></button></span>
              <input type="text" class="form-control formdate" name="dari" id="DariTanggal" required="true" placeholder="Dari Tanggal">
            </div>
            <div class="col input-group">
              <span class="input-group-addon" id="sizing-addon1">
                <i class="fas fa-chevron-right"></i></span>
              <input type="text" class="form-control formdate" name="sampai" id="SampaiTanggal" required="true" placeholder="Sampai Tanggal">
            </div>
            <div class="col input-group">
              <button type="submit" class="btn btn-primary"> <i class="fas fa-check-circle"></i> Submit</button>
            </div>
          </form>
        </div>
        <form method="post" action="<?= site_url('barang_masuk/deletebulk'); ?>" id="formbulk">
          <div class="mailbox-messages">
            <table class="table table-hover" style="margin-bottom: 10px" style="width:100%">
              <tr>
                <!-- <th style="width: 10px;"><input type="checkbox" name="selectall" /></th> -->
                <th>
                  <center>No</center>
                </th>
                <th>Nama Penyetuju</th>
                <th>Supplier</th>
                <th>Harga Barang</th>
                <th>Jumlah Barang</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Status</th>



                <!-- <th>Action</th> -->
              </tr>
              <?php
              foreach ($barang_masuk_data as $barang_masuk) :
              ?>


                <tr>

                  <td>
                    <center><?php echo ++$start ?></center>
                  </td>
                  <td><?php
                      $first_name = $this->db->query("select first_name,last_name from users where id=$barang_masuk->id_user")->row()->first_name;
                      $last_name = $this->db->query("select first_name,last_name from users where id=$barang_masuk->id_user")->row()->last_name;
                      echo $first_name . " " . $last_name;
                      ?></td>
                  <td><?php
                      $supplier = $this->db->query("select * from kelola_supplier where id=$barang_masuk->id_supplier")->row()->nama;

                      echo $supplier ?></td>
                  <td><strong><?php echo $barang_masuk->harga_barang ?></strong></td>
                  <td><?php echo $barang_masuk->jml_barang_masuk ?></td>
                  <td><?php echo $barang_masuk->total_harga ?></td>
                  <td><?php echo $barang_masuk->tgl_masuk ?></td>
                  <td><?php echo status_barang($barang_masuk->status) ?></td>

                </tr>
              <?php endforeach ?>

            </table>
          </div>

        </form>
        <div class="row">
          <div class="col-md-6">
            <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
          </div>
          <div class="col-md-6 text-right">
            <?php echo $pagination ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>