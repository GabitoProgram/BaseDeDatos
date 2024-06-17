<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>

<h3 class="my-3">Recordatorios</h3>

<form action="<?= base_url('recordatorios/'.$recordatorios['id_R']); ?>" class="row g-3" method="post" autocomplete="off">
    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="recordatorios_id" value="<?= $recordatorios['id_R']; ?>">
 
    <div class="col-md-4">
        <label for="id_C" class="form-label">ID_C</label>
        <select class="form-select" id="id_C" name="id_C" required>
            <option value="">Seleccionar</option>
            <?php foreach ($citas as $citas) : ?>
                <option value="<?= $citas['id_C']; ?>" 
                <?php echo( $citas['id_C']== $recordatorios['id_C'])? 'selected' : ''; ?>><?= $citas['motivo']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-8">
        <label for="tipoRecordatorio" class="form-label">tipo De Recordatorio</label>
        <input type="text" class="form-control" id="tipoRecordatorio" name="tipoRecordatorio" value="<?= $recordatorios['tipoRecordatorio']; ?>" required>
    </div>

    <div class="col-md-6">
        <label for="FechaHoraEnvio" class="form-label"> FechaHoraEnvio</label>
        <input type="text" class="form-control" id="FechaHoraEnvio" name="FechaHoraEnvio" value="<?= $recordatorios['FechaHoraEnvio']; ?>" required>
    </div>

    <div class="col-md-6">
        <label for="Estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="Estado" name="Estado" value="<?= $recordatorios['Estado']; ?>"required>
    </div>

    <div class="col-12">
        <a href="<?= base_url('recordatorios') ?>" class="btn btn-secondary">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

</form>

<?= $this->endSection(); ?>