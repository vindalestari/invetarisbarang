<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Pengajuan</h3>
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
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
                        <label for="id_barang">Barang</label>
                        <select class="form-control select2" required="true" name="id_barang">
                            <?php

                            foreach ($barang as $value) {
                                echo "<option value='" . $value->id . "'";
                                if (isset($id_barang)) {
                                    if ($id_barang == $value->id) {
                                        echo " selected";
                                    }
                                }
                                echo ">" . $value->nama_barang . "</option>";
                            }
                            ?>
                        </select>
                    </div>
	    <div class="form-group">
            <label for="varchar">Jumlah Barang <?php echo form_error('jumlah_barang') ?></label>
            <input type="number" min="1" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" value="<?php echo $jumlah_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Harga Satuan Barang <?php echo form_error('harga_barang') ?></label>
            <input type="number"  min="1" class="form-control" name="harga_barang" id="harga_barang" placeholder="Harga Satuan Barang" value="<?php echo $harga_barang; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pengajuan') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>