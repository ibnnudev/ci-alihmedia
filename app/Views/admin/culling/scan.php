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
        <form action="<?= base_url('/admin/culling/scan/store') ?>" method="post" class="row" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $culling['id'] ?>">
            <div class="col-md-7">
                <p class="fw-bold ">Belum punya melakukan scan? Silahkan unggah dokumen!</p>
                <div class="form-group">
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
            </div>
            <div class="col-md-5">
                <div class="img-container">
                    <img id="image" src="" class="img-fluid d-none" alt="Picture">
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
        document.getElementById('file').value = '';
        document.getElementById('image').src = '';
        document.getElementById('image').classList.add('d-none');
    }

    document.getElementById('file').addEventListener('change', function() {
        const file = this.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('image').classList.remove('d-none');
            document.getElementById('image').src = e.target.result;
        }

        reader.readAsDataURL(file);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const file = document.getElementById('file');
        const image = document.getElementById('image');

        if (file.files.length > 0) {
            const reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result;
            }

            reader.readAsDataURL(file.files[0]);
        }
    });
</script>
<?= $this->endSection() ?>