<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<?= $this->include('part/nav') ?>
<div class="container my-3">
    <div class="card">
        <div class="row">
            <div class="col-7 bg-secondary rounded-start d-flex justify-content-center align-items-center">
                <img src="/assets/img/<?= $photo['lokasi_file'] ?>" class="img-fluid" alt="" srcset="">
            </div>
            <div class="col-5">
                <div class="card-body overflow-auto">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <h2 class="fw-bold"><?= $photo['judul'] ?> </h2>
                            <span><?= $photo['username'] ?> - <?= $photo['album_name'] ?></span>
                        </div>
                        <div class="d-flex flex-column text-end">
                            <span class="text-black-50"><?= date('l, d-m-Y', strtotime($photo['tanggal'])) ?></span>
                            <form action="<?= base_url('LikeKomen/like') ?>" method="post">
                                <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
                                <input type="hidden" name="foto_id" value="<?= $photo['id'] ?>">
                                <button type="submit" class="border-0 bg-body"><i class="iconoir-heart<?= ($isLiked) ? '-solid text-danger' : '' ?>"></i> Like <?= count($like) ?></button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bolder">Deskripsi:</h5>
                        <?php if (session()->get('user_id') == $photo['user_id']) : ?>
                            <div>
                                <a href="<?= base_url('photos/edit/' . $photo['id']) ?>" class="btn btn-primary"><i class="iconoir-page-edit"></i>Edit</a>
                                <a href="<?= base_url('photos/delete/' . $photo['id']) ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus foto ini?')" class="btn btn-danger"><i class="iconoir-bin"></i>Hapus</a>
                            </div>
                        <?php endif ?>
                    </div>
                    <p><?= $photo['deskripsi'] ?></p>
                    <hr>
                    <div class="h-100">
                        <h5 class="fw-bolder">Komentar:</h5>
                        <div class="overflow-auto" style="height: 300px;">
                            <?php foreach ($komentar as $k) : ?>
                                <div class="d-flex justify-content-between w-100 border-bottom mb-2 border p-2 rounded-1">
                                    <div>
                                        <span class="d-block"><?= $k['username'] ?> <span class="text-black-50" style="font-size: 10px;"><?= date('d-m-Y, g:i:s', strtotime($k['tanggal'])) ?></span></span>
                                        <span><?= $k['isi_komentar'] ?></span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <?php if ($k['user_id'] == session()->get('user_id')) : ?>
                                            <form action="<?= base_url('LikeKomen/deletekomen') ?>">
                                                <input type="hidden" name="id" value="<?= $k['id'] ?>">
                                                <input type="hidden" name="foto_id" value="<?= $k['foto_id'] ?>">
                                                <input type="submit" class="text-danger border-0 bg-body" onclick="return confirm('Anda yakin ingin menghapus komen ini?')" style="font-size: 12px;" value="hapus">
                                            </form>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="sticky-bottom mt-3">
                            <form action="<?= base_url('LikeKomen/addkomen/' . $photo['id']) ?>" method="post">
                                <div class="input-group">
                                    <textarea type="text" name="isi_komentar" class="form-control" id="isi_komentar" rows="3" required></textarea>
                                    <input type="submit" name="Comment" class="btn btn-primary" value="Kirim">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>