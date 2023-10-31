<?php 
require_once 'controller/sede.controller.php'; 
$sede = new SedeController; ?>

<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Instalaciones</h4>
                  <p class="card-description">
                    Listado de los Instalaciones de la Empresa.
                  </p>
                  <div class="table-responsive">
                    <?php  $instalaciones = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Instalacion</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($instalaciones as $instalacion): ?>
                      <tr>
                        <td><?php echo $instalacion['idInstalacion']; ?></td>
                        <td><?php echo $instalacion['Nombre']; ?></td>
                        <?php if ($instalacion['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarInstalacion" idInstalacion="<?php echo $instalacion['idInstalacion']; ?>" Nombre="<?php echo $instalacion['Nombre']; ?>" Descripcion="<?php echo $instalacion['Descripcion']; ?>" Sede_id="<?php echo $instalacion['Sede_id']; ?>" Estado="<?php echo $instalacion['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarInstalacion" idInstalacion="<?php echo $instalacion['idInstalacion']; ?>"><i class="ti-eraser"></i></button>                         
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  </table>
                      
                      

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Registrar Instalacion</h4>
                  <form class="forms-sample" action="?c=Instalacion&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Sede_id" class="col-sm-12 col-form-label">Sede</label>
                      <select class="form-control" id="Sede_id" name="Sede_id"  required>
                        <option value="0">-- Seleccione Sedes --</option>       
                        <?php $sedes = $sede->Listar(); ?>
                        <?php foreach ($sedes as $sede): ?>                     
                          <option value="<?php echo $sede['idSede']; ?>"><?php echo $sede['Nombre']; ?></option>                      
                        <?php endforeach; ?>
                     </select>
                    </div>
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre"  placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                      <label for="Descripcion" class="col-sm-12 col-form-label">Descripcion</label>
                        <input type="text" class="form-control" id="Descripcion" name="Descripcion"  placeholder="Descripcion">
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Registrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
                
              <div class="card" style="margin-top: 2em;">
                <div class="card-body">
                  <h4 class="card-title">Actualizar Instalación</h4>
                  <form class="forms-sample" action="?c=Instalacion&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidInstalacion" class="col-sm-12 col-form-label">Id Instalacion</label>
                        <input type="text" class="form-control" id="updidInstalacion" name="idInstalacion"  placeholder="Instalacion" required readonly>
                    </div>

                    <div class="form-group">
                      <label for="updSede_id" class="col-sm-12 col-form-label">Sede</label>
                      <select class="form-control" id="updSede_id" name="Sede_id"  required>
                        <option value="0">-- Seleccione Sede --</option>       
                        
                        <?php foreach ($sedes as $sede): ?>                     
                          <option value="<?php echo $sede['idSede']; ?>"><?php echo $sede['Nombre']; ?></option>                      
                        <?php endforeach; ?>
                     </select>
                    </div>
                    <div class="form-group">
                      <label for="updNombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="updNombre" name="Nombre"  placeholder="Nombre Area" required>
                    </div>
                    <div class="form-group">
                      <label for="updDescripcion" class="col-sm-12 col-form-label">Descripcion</label>
                        <input type="text" class="form-control" id="updDescripcion" name="Descripcion"  placeholder="Descripcion" required>
                    </div>
                    <div class="form-group">
                      <label for="updEstado" class="col-sm-12 col-form-label">Estado</label>
                      <select class="form-control" id="updEstado" name="Estado"  required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
	                   </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Actualizar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
            </div>

 <script>
$(document).ready(function() {
  $(document).on('click', '.btn-ActualizarInstalacion', function() {
    
    $('#updidInstalacion').val($(this).attr('idInstalacion'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updSede_id').val($(this).attr('Sede_id'));
    $('#updDescripcion').val($(this).attr('Descripcion'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarInstalacion', function() {
    idInstalacion=$(this).attr('idInstalacion');
    Swal.fire({
      title: '¿Desea eliminar la Instalacion?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Instalacion&a=Eliminar&idInstalacion="+idInstalacion; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




