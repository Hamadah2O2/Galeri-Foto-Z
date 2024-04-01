<?= $this->extend("layout/base") ?>

<?= $this->section('content') ?>
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow rounded-0" style="width: 450px;">
        <div class="card-header">
            <h3 class="card-title">Registrasi</h3>
        </div>
        <div class="card-body">
            <?= $this->include('part/alert') ?>
            <form action="  ">
                <input type="text" class="form-control mb-2" name="username" value="<?= old('username') ?>" placeholder="Username" required>
                <input type="email" class="form-control mb-2" name="email" value="<?= old('email') ?>" placeholder="Email" required>
                <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
                <input type="password" class="form-control mb-2" name="cpassword" placeholder="Confirm Password" required>
                <textarea name="alamat" id="alamat" class="form-control mb-2" placeholder="Alamat" cols="30" rows="5"><?= old('alamat') ?></textarea>
                <input type="submit" name="submit" value="Register" class="w-100 btn btn-primary mb-2">
                <div class="d-flex justify-content-between flex-column">
                    <span>Sudah mempunyai akun? <a href="<?= base_url('auth/login') ?>">Login</a></span>
                    <span>Kembali ke <a href="<?= base_url() ?>">Beranda</a></span>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>