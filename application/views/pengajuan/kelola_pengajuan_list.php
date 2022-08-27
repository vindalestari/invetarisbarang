<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Kelola Pengajuan</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>

            <div class="box-body">
                <?php
                if ($this->session->flashdata('success')) :
                ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">

                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                    </div>
                    <div class="col-md-3 text-right">
                        <form action="<?php echo site_url('kelola_barang_keluar/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
                                    if ($q <> '') {
                                    ?>
                                        <a href="<?php echo site_url('kelola_barang_keluar'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                    }
                                    ?>
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <form method="post" action="<?= site_url('kelola_barang_keluar/deletebulk'); ?>" id="formbulk">
                    <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
                        <tr>

                            <th>No</th>
                            <th>Nama Pendistribusi</th>
                            <th>Nama Barang</th>
                            <th>Jml Barang Keluar</th>
                            <th>Tgl Keluar</th>
                            <th>Tujuan</th>
                            <th>Status Penerimaan</th>
                            <th>Action</th>
                        </tr><?php
                                foreach ($kelola_pengajuan_data as $kelola_pengajuan) {
                                ?>
                            <tr>



                                <td width="80px"><?php echo ++$start ?></td>
                                <td><?php
                                    $first_name = $this->db->query("select first_name,last_name from users where id=$kelola_pengajuan->id_user")->row()->first_name;
                                    $last_name = $this->db->query("select first_name,last_name from users where id=$kelola_pengajuan->id_user")->row()->last_name;
                                    echo $first_name . " " . $last_name;
                                    ?></td>
                                <td><?php
                                    $nama_barang = $this->db->get_where('kelola_barang', ['id' => $kelola_pengajuan->id_barang])->row();
                                    echo $nama_barang->nama_barang;

                                    ?></td>
                                <td><?php echo $kelola_pengajuan->jml_barang_keluar ?></td>
                                <td><?php echo $kelola_pengajuan->tgl_keluar ?></td>
                                <td><?php echo $kelola_pengajuan->tujuan ?></td>
                                <td><?php echo $kelola_pengajuan->status_penerimaan ?></td>
                                <td style="text-align:center" width="200px">

                                    <?php if ($kelola_pengajuan->status_penerimaan == 'Belum Diterima') : ?>
                                        <a href="<?php echo site_url('Pengajuan/terima/' . $kelola_pengajuan->id); ?>" class="btn btn-xs btn-success">Terima</a>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php
                                }
                        ?>
                    </table>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
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
    $(':checkbox[name=selectall]').click(function() {
        $(':checkbox[name=id]').prop('checked', this.checked);
    });

    $("#formbulk").on("submit", function() {
        var rowsel = [];
        $.each($("input[name='id']:checked"), function() {
            rowsel.push($(this).val());
        });
        if (rowsel.join(",") == "") {
            alertify.alert('', 'Tidak ada data terpilih!', function() {});

        } else {
            var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?',
                'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
                ok: 'Yakin',
                cancel: 'Batal!'
            }).set('onok', function(closeEvent) {

                $.ajax({
                    url: "kelola_barang_keluar/deletebulk",
                    type: "post",
                    data: "msg = " + rowsel.join(","),
                    success: function(response) {
                        if (response == true) {
                            location.reload();
                        }
                        //console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });
            $(".ajs-header").html("Konfirmasi");
        }
        return false;
    });
</script>