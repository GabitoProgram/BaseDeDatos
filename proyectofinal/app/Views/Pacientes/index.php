<?php echo $this->extend('plantilla'); ?>

<?= $this->section('contenido'); ?>
<h3 class="my-3" id="titulo">PACIENTES</h3>

<a href="<?= base_url('pacientes/new'); ?>" class="btn btn-success">Agregar</a>

<table class="table table-hover table-bordered my-3" aria-describedby="titulo">
    <thead class="table-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Fecha De Nacimiento</th>
            <th scope="col">Genero</th>
            <th scope="col">Direccion</th>
            <th scope="col">OPCIONES</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($pacientes as $pacientes) : ?>
            <tr>
                <td><?= $pacientes['nombre']; ?></td>
                <td><?= $pacientes['Email']; ?></td>
                <td><?= $pacientes['telefono']; ?></td>
                <td><?= $pacientes['FechaNacimiento']; ?></td>
                <td><?= $pacientes['genero']; ?></td>
                <td><?= $pacientes['direccion']; ?></td>
                <td>
                    <a href="<?= base_url('pacientes/' . $pacientes['id_P'] . '/edit'); ?>" class="btn btn-warning btn-sm me-2">Editar</a>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminaModal" 
                    data-bs-url="<?= base_url('pacientes/'.$pacientes['id_P']); ?>">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
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