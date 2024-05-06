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
        <a href="/admin/culling" class="btn btn-primary mb-3">Kembali</a>
        <form action="<?= base_url('admin/culling/store') ?>" method="post">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="norm" class="form-label">No. RM</label>
                        <select class="form-select" required id="norm" name="norm">
                            <option value="">Pilih No.RM</option>
                            <?php foreach ($patients as $patient) : ?>
                                <option value="<?= $patient['norm'] ?>"><?= $patient['norm'] . ' - ' . $patient['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="diagnose" class="form-label">Diagnosa</label>
                        <input type="text" class="form-control" required id="diagnose" name="diagnose">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" required id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="scan_status" class="form-label">Status Scan</label>
                        <select class="form-select" required id="scan_status" name="scan_status">
                            <option value="">Pilih Status Scan</option>
                            <option value="1">Sudah di-scan</option>
                            <option value="0">Belum di-scan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="culling_date" class="form-label">Tanggal Pelestarian</label>
                        <input type="date" class="form-control" required id="culling_date" name="culling_date">
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
        document.getElementById('norm').value = '';
        document.getElementById('diagnose').value = '';
        document.getElementById('description').value = '';
        document.getElementById('scan_status').value = '';
        document.getElementById('culling_date').value = '';
    }
</script>
<?= $this->endSection() ?>