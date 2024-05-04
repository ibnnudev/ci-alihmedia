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
        <a href="/admin/cases" class="btn btn-primary mb-3">Kembali</a>
        <form action="<?= base_url('admin/cases/update/' . $data['id']) ?>" method="POST">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kasus</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?= $data['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="active_ri" class="form-label">Masa Aktif</label>
                        <input type="number" class="form-control" id="active_ri" name="active_ri" required value="<?= $data['active_ri'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inactive_ri" class="form-label">Masa Inaktif</label>
                        <input type="number" class="form-control" id="inactive_ri" name="inactive_ri" required value="<?= $data['inactive_ri'] ?>">
                    </div>
                </div>
            </div>
            <div class="jusfify-content-center align-items-center text-center mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <button type="button" class="btn btn-light" onclick="resetForm()">Reset</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    function resetForm() {
        // reset form
        document.getElementById('name').value = '';
        document.getElementById('active_ri').value = '';
        document.getElementById('inactive_ri').value = '';
    }
</script>
<?= $this->endSection() ?>