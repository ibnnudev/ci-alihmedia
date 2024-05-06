<?= $this->extend('layouts/admin/template') ?>
<?= $this->section('content') ?>
<?= $breadcrumbs ?>
<div class="card mb-4">
    <div class="card-body">
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="mb-4 alert alert-<?= session()->getFlashdata('message')[0] ?> alert-dismissible fade show" role="alert">
                <?php
                foreach (session()->getFlashdata('message')[1] as $key => $value) {
                    echo $value . '<br>';
                }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <a href="/admin/user" class="btn btn-primary mb-3">Kembali</a>
        <form action="<?= base_url('admin/user/update/' . $data['id']) ?>" method="post">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" required id="name" name="name" value="<?= $data['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" required id="email" name="email" value="<?= $data['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" required id="username" name="username" value="<?= $data['username'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" required id="position" name="position" value="<?= $data['position'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Role</label>
                        <select class="form-select" required id="level" name="level">
                            <option value="">Pilih Role</option>
                            <option value="admin" <?= ($data['level'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= ($data['level'] == 'user') ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="jusfify-content-center align-items-center text-center mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-light" onclick="resetForm()">Reset</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    function resetForm() {
        document.getElementById("email").value = "";
        document.getElementById("username").value = "";
        document.getElementById("position").value = "";
        document.getElementById("level").value = "";
    }
    document.getElementById("username").addEventListener("input", function() {
        let username = this.value;
        // dont allow space
        if (username.includes(' ')) {
            this.value = username.replace(/\s/g, '');
            alert('Username tidak boleh menggunakan spasi');
        }
    });
</script>
<?= $this->endSection() ?>