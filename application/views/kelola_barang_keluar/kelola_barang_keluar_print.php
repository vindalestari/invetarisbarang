<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Kelola Barang Keluar</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id User</th>
		<th>Id Barang</th>
		<th>Nama Barang</th>
		<th>Jml Barang Keluar</th>
		<th>Tgl Keluar</th>
		<th>Tujuan</th>
		
            </tr><?php
            foreach ($kelola_barang_keluar_data as $kelola_barang_keluar)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kelola_barang_keluar->id_user ?></td>
		      <td><?php echo $kelola_barang_keluar->id_barang ?></td>
		      <td><?php echo $kelola_barang_keluar->nama_barang ?></td>
		      <td><?php echo $kelola_barang_keluar->jml_barang_keluar ?></td>
		      <td><?php echo $kelola_barang_keluar->tgl_keluar ?></td>
		      <td><?php echo $kelola_barang_keluar->tujuan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>