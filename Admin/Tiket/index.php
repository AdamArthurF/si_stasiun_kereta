<?php require_once('../../core/Tiket.php');
require_once('../../core/Stasiun.php');
require_once('../../core/Kereta.php');
require_once('../../core/Penumpang.php');
require_once('../layouts/header.php');
$tiket = new tiket();
$stasiun = new Stasiun();
$kereta = new Kereta();
$penumpang = new Penumpang();

if (isset($_POST['tambahTiket'])):
    if ($tiket->insert($_POST)):?>
    <div class="tiket-success" data-isi="<?= $_POST['pesan'] ?>"></div>
    <?php else: ?>
    <div class="tiket-fail" data-isi="Gagal Ditambahkan!"></div>
    <?php endif;
endif;

// Ubah data
if (isset($_POST['ubahTiket'])):
    if ($tiket->update($_POST)): ?>
    <div class="tiket-success" data-isi="<?= $_POST['pesan'] ?>"></div>
    <?php else: ?>
        <div class="tiket-fail" data-isi="Gagal Diubah!"></div>
    <?php endif;
endif;

// Hapus data
if (isset($_POST['hapusTiket'])):
    if ($tiket->delete($_POST)): ?>
        <div class="tiket-success" data-isi="<?= $_POST['pesan'] ?>"></div>
    <?php else: ?>
        <div class="tiket-fail" data-isi="Gagal Dihapus!"></div>
    <?php endif;
endif;
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data Tiket</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Tiket</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Data Tiket
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tiketModal">Tambah Data Tiket</button>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama penumpang</th>
                                <th>Stasiun Keberangkatan</th>
                                <th>Stasiun Tujuan</th>
                                <th>Nama Kereta</th>
                                <th>jam berangkat</th>
                                <th>jam tiba</th>
                                <th>waktu tempuh</th>
                                <th>harga tiket</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama penumpang</th>
                                <th>Stasiun Keberangkatan</th>
                                <th>Stasiun Tujuan</th>
                                <th>Nama Kereta</th>
                                <th>jam berangkat</th>
                                <th>jam tiba</th>
                                <th>waktu tempuh</th>
                                <th>harga tiket</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 0; foreach($tiket->fetchAll() as $data): ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= $data->nama_penumpang ?></td>
                                    <td><?= $data->stasiun_berangkat ?></td>
                                    <td><?= $data->stasiun_tiba ?></td>
                                    <td><?= $data->nama_kereta ?></td>
                                    <td><?= $data->berangkat ?></td>
                                    <td><?= $data->tiba ?></td>
                                    <td><?= $data->durasi ?></td>
                                    <td>Rp.<?= $data->harga ?></td>
                                    <td>
                                        <a href="edit.php?id_tiket=<?= $data->id_tiket ?>" class="btn btn-warning font-weight-bold">Edit</a>
                                        <form action="" method="post" class="form-inline d-inline">
                                            <input type="hidden" name="id_tiket" value="<?= $data->id_tiket ?>">
                                            <input type="hidden" name="pesan" value="Berhasil Dihapus!">
                                            <input type="hidden" name="hapusTiket">
                                            <button type="submit" class="tombolHapustiket btn btn-danger font-weight-bold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="tiketModal" tabindex="-1" aria-labelledby="tiketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="tiketModalLabel">Tambah Data tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_penumpang">nama penumpang</label>
                        <select id="id_penumpang" class="form-control custom-select" name="id_penumpang" >
                             <?php foreach($penumpang->fetchAll() as $item ): ?>
                                <option value="<?= $item->id_penumpang ?>"><?= $item->nama_penumpang ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_kereta">Nama Kereta</label>
                        <select id="id_kereta" class="form-control custom-select" name="id_kereta" >
                            <?php foreach ($kereta->fetchAll() as $item): ?>
                                <option value="<?= $item->id_kereta ?>"><?= $item->nama_kereta ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_stasiun_asal">Stasiun asal</label>
                        <select id="id_stasiun_asal" class="form-control custom-select" name="id_stasiun_asal" >
                             <?php foreach($stasiun->fetchAll() as $item ): ?>
                                <option value="<?= $item->id_stasiun ?>"><?= $item->nama_stasiun ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_stasiun_tujuan">Stasiun Tujuan</label>
                        <select id="id_stasiun_tujuan" class="form-control custom-select" name="id_stasiun_tujuan" >
                             <?php foreach($stasiun->fetchAll() as $item ): ?>
                                <option value="<?= $item->id_stasiun ?>""><?= $item->nama_stasiun ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="berangkat">berangkat</label>
                        <input type="date" id="berangkat" class="form-control" name="berangkat" required>
                    </div>
                    <div class="form-group">
                        <label for="tiba">tiba</label>
                        <input type="date" id="tiba" class="form-control" name="tiba" required>
                    </div>
                    <div class="form-group">
                        <label for="durasi">durasi</label>
                        <input type="text" id="durasi" class="form-control" name="durasi" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">harga</label>
                        <input type="number" id="harga" class="form-control" name="harga" required>
                    </div>
                </div>
                <input type="hidden" name="pesan" value="Berhasil Ditambahkan!">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary" name="tambahTiket">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <?= "Halo" ?>

</div>
<?php require_once('../layouts/footer.php') ?>