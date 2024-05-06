<?= $this->extend('layouts/admin/template') ?>
<?= $this->section('content') ?>
<?= $breadcrumbs ?>
<div class="card mb-4">
    <div class="card-body">
        <a href="/admin/patient" class="btn btn-primary mb-3">Kembali</a>
        <form action="<?= base_url('admin/patient/store') ?>" method="post">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="norm" class="form-label">No. Rekam Medis</label>
                        <input type="text" class="form-control" required id="norm" value="<?= $norm ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="number" class="form-control" required name="nik" id="nik" required />
                    </div>
                    <div class="mb-3">
                        <label for="birth_place" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" required id="birth_place" name="birth_place">
                    </div>
                    <div class="mb-3">
                        <label for="village" class="form-label">Desa</label>
                        <input type="text" class="form-control" required id="village" name="village">
                    </div>
                    <div class="mb-3">
                        <label for="district" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" required id="district" name="district">
                    </div>
                    <div class="mb-3">
                        <label for="regency" class="form-label">Kabupaten/Kota</label>
                        <input type="text" class="form-control" required id="regency" name="regency">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" required id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="gender" required id="gender">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="religion" class="form-label">Agama</label>
                        <select class="form-select" name="religion" required id="religion">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" required id="birth_date" name="birth_date">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" name="address" required id="address"></textarea>
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
        // reset form
        document.getElementById('nik').value = '';
        document.getElementById('birth_place').value = '';
        document.getElementById('address').value = '';
        document.getElementById('name').value = '';
        document.getElementById('gender').value = 'L';
        document.getElementById('birth_date').value = '';
        document.getElementById('village').value = '';
        document.getElementById('district').value = '';
        document.getElementById('regency').value = '';
        document.getElementById('religion').value = 'Islam';
    }
</script>
<?= $this->endSection() ?>