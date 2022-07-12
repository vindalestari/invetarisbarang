<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Pengajuan</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
      </div>

      <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php if($this->ion_auth->in_group(1)): ?>
                <?php echo anchor(site_url('pengajuan/create'),'<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?>
                <?php endif; ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right"><form action="<?php echo site_url('pengajuan/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pengajuan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('pengajuan/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
                <th>No</th>
		<th>Nama Barang</th>
        <th>Nama Supplier</th>
		<th>Jumlah Barang</th>
		<th>Tanggal Pengajuan</th>
		<th>Status</th>
		<th>Action</th>
            </tr><?php
            foreach ($pengajuan_data as $pengajuan)
            {
                ?>
                <tr>
                
                
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php 
            $nama_barang = $this->db->query("select nama_barang from kelola_barang where id=$pengajuan->id_barang")->row()->nama_barang;
            echo $nama_barang;
            ?></td>
           <td><?php 
            $nama_supplier = $this->db->query("select nama from kelola_supplier where id=$pengajuan->id_supplier")->row()->nama;
            echo $nama_supplier;
            ?></td>
			<td><?php echo $pengajuan->jumlah_barang ?></td>
			<td><?php echo $pengajuan->tanggal_pengajuan ?></td>
			<td><?php echo cek_status_pengajuan($pengajuan->status); ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pengajuan/read/'.$pengajuan->id),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'); 
				?>
                 <?php if($this->ion_auth->in_group(6) and $pengajuan->status ==0): ?>
                    <a href="<?php echo site_url('Pengajuan/setujui/'.$pengajuan->id) ;?>" class="btn btn-xs btn-success">Setujui</a>
                    <a href="<?php echo site_url('Pengajuan/tidak_disetujui/'.$pengajuan->id); ?>"  class="btn btn-xs btn-danger">Tidak disetujui</a>
                 <?php endif; ?>

			</td>
		</tr>
                <?php
            }
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-md-6">
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>
<script>
    function confirmdelete(linkdelete) {
        alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
            location.href = linkdelete;
        }, function() {
            alertify.error("Penghapusan data dibatalkan.");
        });
        $(".ajs-header").html("Konfirmasi");
        return false;
    }
    $(':checkbox[name=selectall]').click(function () {
        $(':checkbox[name=id]').prop('checked', this.checked);
    });

    $("#formbulk").on("submit", function () {
        var rowsel = [];
        $.each($("input[name='id']:checked"), function () {
            rowsel.push($(this).val());
        });
        if (rowsel.join(",") == "") {
            alertify.alert('', 'Tidak ada data terpilih!', function () {});

        } else {
            var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?',
                'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
                ok: 'Yakin',
                cancel: 'Batal!'
            }).set('onok', function (closeEvent) {

                $.ajax({
                    url: "pengajuan/deletebulk",
                    type: "post",
                    data: "msg = " + rowsel.join(","),
                    success: function (response) {
                        if (response == true) {
                            location.reload();
                        }
                        //console.log(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });
            $(".ajs-header").html("Konfirmasi");
        }
        return false;
    });
     
</script>