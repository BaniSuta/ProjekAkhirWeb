<table>
    <thead>
        <tr>
            <th>Nomor Peminjaman</th>
            <th>Nama User</th>
            <th>Nama Console</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($trans)) : ?>
            <?php foreach ($trans as $transaksi) : ?>
                <tr>
                    <td><?= $transaksi["id_transaksi"] ?></td>
                    <td><?= $transaksi["username"] ?></td>
                    <td><?= $transaksi["nama_console"] ?></td>
                    <td><?= date("d-m-Y", strtotime($transaksi["tgl_awal"])) ?></td>
                    <td><?= date("d-m-Y", strtotime($transaksi["tgl_akhir"])) ?></td>

                    <td>
                        <?php if (strtotime("now") < strtotime($transaksi["tgl_akhir"]) && $transaksi["status"] == 0) {
                            echo "<p style='background-color: skyblue; border-radius: 5px; padding: 4px; color: #efefef;'>Belum Jatuh Tempo</p>";
                        } else if (strtotime("now") > strtotime($transaksi["tgl_akhir"]) && $transaksi["status"] == 0) {
                            echo "<p style='background-color: red; border-radius: 5px; padding: 4px; color: #efefef;'>Sudah Jatuh Tempo</p>";
                        } ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>