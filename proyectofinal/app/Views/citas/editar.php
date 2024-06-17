<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<h3 class="my-3">Editar Cita</h3>

<?php if (session()->getFlashdata('error') !== null) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    <?php
} ?>
    <form action="<?= base_url('citas/' . $citas['id_C']); ?>" class="row g-3" method="post" autocomplete="off">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="citas_id" value="<?= $citas['id_C']; ?>">

        <div class="col-md-4">
            <label for="id_P" class="form-label">ID_P</label>
            <select class="form-select" id="id_P" name="id_P" required>
                <option value="">Seleccionar</option>
                <?php foreach ($pacientes as $pacientes) : ?>
                    <option value="<?= $pacientes['id_P']; ?>" 
                    <?php echo($pacientes['id_P' ] == $citas['id_P']) ? 'selected' : ''; ?>><?= $pacientes['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label for="id_D" class="form-label">ID_D</label>
            <select class="form-select" id="id_D" name="id_D" required>
                <option value="">Seleccionar</option>
                <?php foreach ($doctores as $doctores) : ?>
                    <option value="<?= $doctores['id_D']; ?> " 
                    <?php echo($doctores['id_D'] == $citas['id_D']) ? 'selected' : ''; ?>><?= $doctores['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="fechaHora" class="form-label"> Fecha y Hora</label>
            <input type="text" class="form-control" id="fechaHora" name="fechaHora" value="<?= $citas['fechaHora'];  ?>" required>
        </div>

        <div class="col-md-6">
            <label for="estado" class="form-label"> Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="<?= $citas['estado'];  ?>" required>
        </div>

        <div class="col-md-6">
            <label for="motivo" class="form-label"> Motivo</label>
            <input type="text" class="form-control" id="motivo" name="motivo" value="<?= $citas['motivo'];  ?>">
        </div>


        <div class="col-12">
            <a href="<?= base_url('citas') ?> " class="btn btn-secondary">Regresar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

    <?= $this->endSection(); ?>