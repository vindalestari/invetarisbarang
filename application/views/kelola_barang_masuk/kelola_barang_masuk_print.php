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
    <h3 align="center">DATA Kelola Barang Masuk</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id User</th>
		<th>Id Supplier</th>
		<th>Harga Barang</th>
		<th>Jml Barang Masuk</th>
		<th>Tgl Masuk</th>
		
            </tr><?php
            foreach ($kelola_barang_masuk_data as $kelola_barang_masuk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kelola_barang_masuk->id_user ?></td>
		      <td><?php echo $kelola_barang_masuk->id_supplier ?></td>
		      <td><?php echo $kelola_barang_masuk->harga_barang ?></td>
		      <td><?php echo $kelola_barang_masuk->jml_barang_masuk ?></td>
		      <td><?php echo $kelola_barang_masuk->tgl_masuk ?></td>	
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