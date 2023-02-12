<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<?= $this->include('form') ?>

<div class="container">
    <div class="row mt-3 ">
        <div class="col-md-4">
            <button type="button" onclick="addMhs()" class="btn btn-success">
                Tambah Mahasiswa
            </button>
        </div>
        <div class="col-md-4 position-absolute end-0">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Mahasiswa" id="search-input">
                <button class="btn btn-dark" type="button" id="button-addon2">Cari</button>
            </div>
        </div>
    </div>
</div>
<hr>
<table class="table table-striped">
    <thead class="text-center">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">NPM</th>
            <th scope="col">No.HP</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="text-center">
    </tbody>
</table>
<?= $this->endSection() ?>