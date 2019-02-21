<!DOCTYPE html>
<html>
<head>
  <title>Nota</title>
</head>
<body>
  <center><h1></h1></center>
  <table align="center">
    <thead align="center">
      <tr>
        <td><b>POS INVENTORY TOKO</b></td>
      </tr>
      <tr>
        <td><b>NPWP/ PKP : 1.111111.11111</b></td>
      </tr>
      <tr>
        <td><b>Tanggal Pengukuhan : 10-03-2013</b></td>
      </tr>
    </thead>
  </table>
  <br>
  <table align="center">
    <thead>
      <tr>
        <td><b>No Nota : <?php echo $_GET['noNota'] ?></b></td>
        <td></td>
        <td></td>
        <td></td>
        <td>13/09/2015</td>
      </tr>
      <tr>
        <td width="200"><b>Daftar Barang</b></td>
        <td width="100"><b>Harga@</b></td>
        <td width="100"><b>Disc</b></td>
        <td><b>Qty</b></td>
        <td><b>Subtotal(RP)</b></td>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($query as $key): ?>
        <tr>
          <td><?php echo $key['barang']; ?></td>
          <td><?php echo number_format($key['harga']) ?></td>
          <td><?php echo $key['discount'] ?></td>
          <td><?php echo $key['jumlah'] ?></td>
          <td><?php echo number_format($key['st']) ?></td>
        </tr>
      <?php endforeach ?>
      <tr>
      </tbody>
      <tfoot>
        <tr>
          <td ></td>
          <td width="200"><b>Total Belanja (Rp.) :</b></td>
          <td></td>
          <td></td>
          <td><?php echo number_format($total['total']) ?></td>
        </tr>
        <tr>
          <td ></td>
          <td width="200"><b>Uang Bayar (Rp.) :</b></td>
          <td></td>
          <td></td>
          <td><?php echo number_format($bayar['bayar']) ?></td>
        </tr>
        <tr>
          <td ></td>
          <td width="200"><b>Uang Kembali (Rp.) :</b></td>
          <td></td>
          <td></td>
          <td><?php echo number_format($kembali['kembali'])  ?></td>
        </tr>
        <tr>
          <td>Kasir : Darmawan</td>
        </tr>
      </tfoot>
    </table>
    <script>
      window.print();
      
    </script>
  </body>
  </html>