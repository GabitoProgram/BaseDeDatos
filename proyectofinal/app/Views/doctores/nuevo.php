<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<h3 class="my-3">Nuevo Doctor</h3>
<?php  if(session()->getFlashdata('error') !== null){?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
<?php } ?>


<form action="<?= base_url('doctores') ?>" class="row g-3" method="post" autocomplete="off">

    <div class="col-md-4">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= set_value('nombre') ?>" required autofocus>
    </div>

    <div class="col-md-8">
        <label for="especialidad" class="form-label">Especialidad</label>
        <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?= set_value('especialidad') ?>" required>
    </div>

    <div class="col-md-8">
        <label for="Email" class="form-label">Email</label>
        <input type="text" class="form-control" id="Email" name="Email" value="<?= set_value('Email') ?>" required>
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label"> Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= set_value('telefono') ?>" required>
    </div>

    <div class="col-md-6">
        <label for="horariosConsulta" class="form-label">Horarios De Consulta</label>
        <input type="text" class="form-control" id="horariosConsulta" name="horariosConsulta" value="<?= set_value('horariosConsulta') ?>" required>
    </div>

    <div class="col-12">
        <a href="<?= base_url('doctores') ?>" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>

<?= $this->endSection(); ?>