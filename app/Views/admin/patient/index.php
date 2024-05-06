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
        <a href="/admin/patient/create" class="btn btn-success mb-3">Tambah Pasien</a>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No. RM</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Agama</th>
                    <th>Umur</th>
                    <th>JK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) : ?>
                    <tr>
                        <td><?= $patient['norm'] ?></td>
                        <td><?= $patient['nik'] ?></td>
                        <td><?= $patient['name'] ?></td>
                        <td><?= $patient['religion'] ?></td>
                        <td><?= $patient['age'] ?> tahun</td>
                        <td><?= $patient['gender'] ?></td>
                        <td>
                            <a href="/admin/patient/show/<?= $patient['norm'] ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i></a>
                            <a href="/admin/patient/edit/<?= $patient['norm'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i></a>
                            <a href="/admin/patient/delete/<?= $patient['norm'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>