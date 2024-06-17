<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>
<h3 class="my-3" id="titulo">RECORDATORIO</h3>

<a href="<?= base_url('recordatorios/new'); ?>" class="btn btn-success">Agregar</a>

<table class="table table-hover table-bordered my-3" aria-describedby="titulo">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID_C</th>
            <th scope="col">Tipo De Recordatorio</th>
            <th scope="col">Fecha Hora Envio</th>
            <th scope="col">Estado</th>
            <th scope="col">OPCIONES</th>
        </tr>
    </thead>

    <tbody>


        <?php foreach ($recordatorios as $recordatorios) : ?>
            <tr>
                <td><?= $recordatorios['id_C']; ?></td>
                <td><?= $recordatorios['tipoRecordatorio']; ?></td>
                <td><?= $recordatorios['FechaHoraEnvio']; ?></td>
                <td><?= $recordatorios['Estado']; ?></td>
                <td>
                    <a href="<?= base_url('recordatorios/'.$recordatorios['id_R'].'/edit');?>" class="btn btn-warning btn-sm me-2">Editar</a>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminaModal" 
                    data-bs-url="<?= base_url('recordatorios/'.$recordatorios['id_R']);?>">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
        <!--
        <tr>
            <td>12345</td>
            <td>JUAN PEREZ</td>
            <td>0123456789</td>
            <td>JUANPEREZ@DOMINIO.COM</td>
            <td>RECURSOS HUMANOS</td>
            <td>
                <a href="edita.html" class="btn btn-warning btn-sm me-2">Editar</a>

                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#eliminaModal" data-bs-id="1">Eliminar</button>
            </td>
        </tr>
-->

    </tbody>
</table>
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="eliminaModalLabel">Aviso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <form id="form-elimina" action="" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    const eliminaModal = document.getElementById('eliminaModal')
    if (eliminaModal) {
        eliminaModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const url = button.getAttribute('data-bs-url')

            // Update the modal's content.
            const form = eliminaModal.querySelector('#form-elimina')
            form.setAttribute('action', url)
        })
    }
</script>
<?= $this->endSection(); ?>