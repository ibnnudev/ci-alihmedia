<?= $this->extend('layouts/admin/template') ?>
<?= $this->section('content') ?>
<?= $breadcrumbs ?>
<div class="card mb-4">
    <div class="card-body">
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="mb-4 alert alert-<?= session()->getFlashdata('message')[0] ?> alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message')[1] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <a href="/admin/cases/create" class="btn btn-primary mb-3">Tambah Kasus</a>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kasus</th>
                    <th>Masa Aktif</th>
                    <th>Masa Inaktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cases as $case) : ?>
                    <tr>
                        <td><?= $case['id'] ?></td>
                        <td><?= $case['name'] ?></td>
                        <td><?= $case['active_ri'] . ' tahun' ?></td>
                        <td><?= $case['inactive_ri'] . ' tahun' ?></td>
                        <td>
                            <a href="/admin/cases/edit/<?= $case['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/admin/cases/delete/<?= $case['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>