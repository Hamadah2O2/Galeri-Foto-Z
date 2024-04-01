<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<?= $this->include('part/nav') ?>
<div class="mt-2">
    <div class="container">
        <?= $this->include('part/alert') ?>
    </div>

    <?php if(isset($bigTitle)): ?>
        <div class="container my-4">
            <h2 class="fw-bold"><?= $bigTitle ?></h2>
        </div>
    <?php endif ?>
    <div class="container">
        <div class="masonry">
            <?php foreach ($photos as $p): ?>
                <a href="<?= base_url('photos/detail/'.$p['id']) ?>" class="text-decoration-none text-black">
                    <div class="box">
                        <div class="card">
                            <img src="<?= base_url('assets/img/'.$p['lokasi_file']) ?>" class="card-img-top" alt="">
                            <div class="card-body p-2 d-flex justify-content-between">
                                <div>
                                    <p><?= $p['judul'] ?></p>
                                    <span class="text-black-50">-- <?= $p['username'] ?></span>
                                </div>
                                <div>
                                    <i class="iconoir-heart-solid"></i><span><?= $like->getJumLike($p['id']) ?></span>
                                    <i class="iconoir-chat-bubble"></i><span><?= $komen->getJumKomen($p['id']) ?></span>
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