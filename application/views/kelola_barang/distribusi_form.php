<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Kelola_barang_Keluar</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="varchar">Jumlah Barang Keluar
                            <input type="number" class="form-control" id="jml_barang_keluar" value="<?= $jumlah_barang; ?>" placeholder="Jumlah Barang" disabled />
                            <input type="hidden" class="form-control" name="jml_barang_keluar" id="jml_barang_keluar" value="<?= $jumlah_barang; ?>" placeholder="Jumlah Barang" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Tujuan
                            <input type="text" class="form-control" disabled value="<?= $tujuan; ?>">
                            <input type="hidden" class="form-control" value="<?= $tujuan; ?>" name="tujuan">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('kelola_barang') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>