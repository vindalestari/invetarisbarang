<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Daftar Barang Keluar Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <table class="table">
        
	    <tr><td>Nama Pendistribusi</td><td><?php
                                    $first_name = $this->db->query("select first_name,last_name from users where id=$id_user")->row()->first_name;
                                    $last_name = $this->db->query("select first_name,last_name from users where id=$id_user")->row()->last_name;
                                    echo $first_name . " " . $last_name;
                                    ?></td></tr>
	    <tr>
            <td>Nama Barang</td>
            <td>
            <?php  $nama_barang = $this->db->get_where('kelola_barang', ['id' => $id_barang])->row();
                    echo $nama_barang->nama_barang;  ?>
                                    </td>
                                    </tr>
	    <tr><td>Jml Barang Keluar</td><td><?php echo $jml_barang_keluar; ?></td></tr>
	    <tr><td>Tgl Keluar</td><td><?php echo $tgl_keluar; ?></td></tr>
	    <tr><td>Tujuan</td><td><?php echo $tujuan; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('kelola_barang_keluar') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>