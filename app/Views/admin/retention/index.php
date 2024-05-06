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
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Diagnosa</th>
                    <th>Kunjungan Terakhir</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) : ?>
                    <tr>
                        <td><?= $patient['norm'] ?></td>
                        <td><?= $patient['name'] ?></td>
                        <td><?= $patient['diagnose'] ?></td>
                        <td><?= date('d-m-Y', strtotime($patient['created_at'])) ?></td>
                        <td>
                            <!-- if created at more than 5 year, add badge "inactive" -->
                            <?php if (strtotime($patient['created_at']) < strtotime('-5 year')) : ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php else : ?>
                                <span class="badge bg-primary">Active</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (strtotime($patient['created_at']) < strtotime('-5 year')) : ?>
                                <span class="badge bg-danger">Siap dilestarikan</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Disimpan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- if created at more than 5 year, add badge "inactive" -->
                            <?php if (strtotime($patient['created_at']) < strtotime('-5 year')) : ?>
                                <!-- button delete -->
                                <a href="/admin/patient/delete/<?= $patient['norm'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
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