<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<h3 class="my-3">Recordatorios</h3>

<form action="<?= base_url('recordatorios') ?>" class="row g-3" method="post" autocomplete="off">

    <div class="col-md-4">
        <label for="id_C" class="form-label">ID_C</label>
        <select class="form-select" id="id_C" name="id_C" required>
            <option value="">Seleccionar</option>
            <?php foreach ($recordatorios as $recordatorios) : ?>
                <option value="<?= $recordatorios['id_C']; ?>"><?= $recordatorios['motivo']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-8">
        <label for="tipoRecordatorio" class="form-label">tipo De Recordatorio</label>
        <input type="text" class="form-control" id="tipoRecordatorio" name="tipoRecordatorio" value="<?= set_value('tipoRecordatorio') ?>" required>
    </div>

    <div class="col-md-6">
        <label for="FechaHoraEnvio" class="form-label"> FechaHoraEnvio</label>
        <input type="text" class="form-control" id="FechaHoraEnvio" name="FechaHoraEnvio" value="<?= set_value('FechaHoraEnvio') ?>" required>
    </div>

    <div class="col-md-6">
        <label for="Estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="Estado" name="Estado" value="<?= set_value('Estado') ?>" required>
    </div>

    <div class="col-12">
        <a href="<?= base_url('recordatorios') ?>" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>

<?= $this->endSection(); ?>