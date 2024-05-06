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
        <a href="/admin/preservation/create" class="btn btn-success mb-3">Tambah Pelestarian</a>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Diagnosa</th>
                    <th>Keterangan</th>
                    <th>Status Scan</th>
                    <th>Tanggal Pelestarian</th>
                    <th>Hasil Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($preservations as $preservation) : ?>
                    <tr>
                        <td><?= $preservation['norm'] ?></td>
                        <td><?= $preservation['name'] ?></td>
                        <td><?= $preservation['diagnose'] ?></td>
                        <td><?= $preservation['description'] ?></td>
                        <td><?= $preservation['scan_status'] ? 'Sudah di-scan' : 'Belum di-scan' ?></td>
                        <td><?= $preservation['preservation_date'] ?></td>
                        <td>
                            <?php if ($preservation['file_upload']) : ?>
                                <a href="/uploads/<?= $preservation['file_upload'] ?>" target="_blank" class="btn btn-primary btn-sm">
                                    Lihat berkas
                                </a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/admin/preservation/edit/<?= $preservation['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/admin/preservation/delete/<?= $preservation['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php
                            if ($preservation['scan_status'] == 0) : ?>
                                <a href="/admin/preservation/scan/<?= $preservation['id'] ?>" class="btn btn-primary btn-sm">
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