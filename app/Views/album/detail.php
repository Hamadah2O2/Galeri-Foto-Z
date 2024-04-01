<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<?= $this->include('part/nav') ?>
<div class="mt-2">
    <div class="container">
        <?= $this->include('part/alert') ?>
    </div>

    <div class="container my-4">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="fw-bold"><?= $album['nama'] ?></h2>
                <span class="text-black-50"><?= $album['deskripsi'] ?></span>
            </div>
            <div>
                <?php if ($album['user_id'] == session()->get('user_id')) : ?>
                    <a href="<?= base_url("album/edit/" . $album['id']) ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= base_url("album/delete/" . $album['id']) ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger">Hapus</a>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="masonry">
            <?php foreach ($photos as $p) : ?>
                <a href="<?= base_url('photos/detail/' . $p['id']) ?>" class="text-decoration-none text-black">
                    <div class="box">
                        <div class="card">
                            <img src="<?= base_url('assets/img/' . $p['lokasi_file']) ?>" class="card-img-top img-fluid" alt="">
                            <div class="card-body p-2 d-flex justify-content-between">
                                <div>
                                    <p><?= $p['judul'] ?></p>
                                    <span class="text-black-50">-- <?= $p['username'] ?></span>
                                </div>
                                <div>
                                    <i class="iconoir-heart-solid"></i>
                                    <i class="iconoir-chat-bubble"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>
<div class="m-5"></div>
<?= $this->endSection() ?>