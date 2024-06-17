<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<h3 class="my-3">Modificar Paciente</h3>
<?php  if(session()->getFlashdata('error') !== null){?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
<?php } ?>

<form action="<?= base_url('pacientes/'.$pacientes['id_P']); ?>" class="row g-3" method="post" autocomplete="off">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="pacientes_id" value="<?= $pacientes['id_P']; ?>">
    <div class="col-md-4">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $pacientes['nombre']; ?>" required autofocus>
    </div>

    <div class="col-md-8">
        <label for="Email" class="form-label">Email</label>
        <input type="text" class="form-control" id="Email" name="Email" value="<?= $pacientes['Email']; ?>"  required>
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label"> Telefono</label>
        <input type="text" class="form-control" id="telefono" name="telefono"  value="<?= $pacientes['telefono']; ?>"  required>
    </div>

    <div class="col-md-6">
        <label for="FechaNacimiento" class="form-label">Fecha De Nacimiento</label>
        <input type="text" class="form-control" id="FechaNacimiento" name="FechaNacimiento" value="<?= $pacientes['FechaNacimiento']; ?>"  required>
    </div>

    <div class="col-md-6">
        <label for="genero" class="form-label"> Genero</label>
        <input type="genero" class="form-control" id="genero" name="genero" value="<?= $pacientes['genero']; ?>" >
    </div>

    <div class="col-md-6">
        <label for="direccion" class="form-label">Dirrecion</label>
        <input type="direccion" class="form-control" id="direccion" name="direccion" value="<?= $pacientes['direccion']; ?>" >
    </div>

    <div class="col-12">
        <a href="<?= base_url('pacientes'); ?>" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>

<?= $this->endSection(); ?>