<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<h3 class="my-3">Editar Doctor</h3>
<?php  if(session()->getFlashdata('error') !== null){?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
<?php } ?>


<form action="<?= base_url('doctores/'.$doctores['id_D']); ?>" class="row g-3" method="post" autocomplete="off">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="doctores_id" value="<?= $doctores['id_D']; ?>">
    <div class="col-md-4">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $doctores['nombre']; ?>" required autofocus>
    </div>

    <div class="col-md-8">
        <label for="especialidad" class="form-label">Especialidad</label>
        <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?= $doctores['especialidad']; ?>" required>
    </div>

    <div class="col-md-8">
        <label for="Email" class="form-label">Email</label>
        <input type="text" class="form-control" id="Email" name="Email" value="<?= $doctores['Email']; ?>" required>
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label"> Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $doctores['telefono']; ?>" required>
    </div>

    <div class="col-md-6">
        <label for="horariosConsulta" class="form-label">Horarios De Consulta</label>
        <input type="text" class="form-control" id="horariosConsulta" name="horariosConsulta" value="<?= $doctores['horariosConsulta']; ?>" required>
    </div>

    <div class="col-12">
        <a href="<?= base_url('doctores'); ?>" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>

<?= $this->endSection(); ?>