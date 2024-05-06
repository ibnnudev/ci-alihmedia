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
        <a href="/admin/culling/create" class="btn btn-success mb-3">Tambah Pemusnahan</a>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Diagnosa</th>
                    <th>Keterangan</th>
                    <th>Status Scan</th>
                    <th>Tanggal Pemusnahan</th>
                    <th>Hasil Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cullings as $culling) : ?>
                    <tr>
                        <td><?= $culling['norm'] ?></td>
                        <td><?= $culling['name'] ?></td>
                        <td><?= $culling['diagnose'] ?></td>
                        <td><?= $culling['description'] ?></td>
                        <td><?= $culling['scan_status'] ? 'Sudah di-scan' : 'Belum di-scan' ?></td>
                        <td><?= $culling['culling_date'] ?></td>
                        <td>
                            <?php if ($culling['file_upload']) : ?>
                                <a href="/uploads/<?= $culling['file_upload'] ?>" target="_blank" class="btn btn-warning btn-sm">
                                    Lihat berkas
                                </a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/admin/culling/edit/<?= $culling['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/admin/culling/delete/<?= $culling['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php
                            if ($culling['scan_status'] == 0) : ?>
                                <a href="/admin/culling/scan/<?= $culling['id'] ?>" class="btn btn-primary btn-sm">
                                    Scan dan Upload
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>