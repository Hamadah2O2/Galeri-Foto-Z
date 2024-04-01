<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow rounded-0" style="width: 350px;">
        <div class="card-header">
            <h3 class="card-title">Login</h3>
        </div>
        <div class="card-body">
            <?= $this->include('part/alert') ?>
            <form action="">
                <input type="text" class="form-control mb-2" name="username" placeholder="Username" required>
                <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
                <input type="submit" name="submit" class="w-100 btn btn-primary mb-2">
                <div class="d-flex justify-content-between flex-column">
                    <span>Belum mempunyai akun? <a href="<?= base_url('auth/register') ?>">Registrasi</a></span>
                    <span>Kembali ke <a href="<?= base_url() ?>">Beranda</a></span>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>