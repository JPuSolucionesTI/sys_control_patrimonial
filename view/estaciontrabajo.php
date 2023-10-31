<?php 
require_once 'controller/instalacion.controller.php'; 
$instalacion = new InstalacionController; ?>

<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Estaciones de Trabajo</h4>
                  <p class="card-description">
                    Listado de las estaciones de trabajo de la Empresa.
                  </p>
                  <div class="table-responsive">
                    <?php  $estacionestrabajo = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Estación Trabajo</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($estacionestrabajo as $estaciontrabajo): ?>
                      <tr>
                        <td><?php echo $estaciontrabajo['idEstacion_Trabajo']; ?></td>
                        <td><?php echo $estaciontrabajo['Nombre']; ?></td>
                        <?php if ($estaciontrabajo['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarEstacionTrabajo" idEstacion_Trabajo="<?php echo $estaciontrabajo['idEstacion_Trabajo']; ?>" Nombre="<?php echo $estaciontrabajo['Nombre']; ?>" Descripcion="<?php echo $estaciontrabajo['Descripcion']; ?>" Instalacion_id="<?php echo $estaciontrabajo['Instalacion_id']; ?>" Estado="<?php echo $estaciontrabajo['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarEstacionTrabajo" idEstacion_Trabajo
="<?php echo $estaciontrabajo['idEstacion_Trabajo']; ?>"><i class="ti-eraser"></i></button>                         
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
                  <h4 class="card-title">Registrar Estación Trabajo</h4>
                  <form class="forms-sample" action="?c=EstacionTrabajo&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Instalacion_id" class="col-sm-12 col-form-label">Instalación</label>
                      <select class="form-control" id="Instalacion_id" name="Instalacion_id"  required>
                        <option value="0">-- Seleccionar Instalación --</option>       
                        <?php $instalaciones = $instalacion->Listar(); ?>
                        <?php foreach ($instalaciones as $instalacion): ?>                     
                          <option value="<?php echo $instalacion['idInstalacion']; ?>"><?php echo $instalacion['Nombre']; ?></option>                      
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
                  <h4 class="card-title">Actualizar Estación Trabajo</h4>
                  <form class="forms-sample" action="?c=EstacionTrabajo&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidEstacion_Trabajo" class="col-sm-12 col-form-label">id Estacion_Trabajo</label>
                        <input type="text" class="form-control" id="updidEstacion_Trabajo" name="idEstacion_Trabajo"  placeholder="Estacion Trabajo" required readonly>
                    </div>

                    <div class="form-group">
                      <label for="updInstalacion_id" class="col-sm-12 col-form-label">Instalación</label>
                      <select class="form-control" id="updInstalacion_id" name="Instalacion_id"  required>
                        <option value="0">-- Seleccionar Instalacion --</option>       
                        
                        <?php foreach ($instalaciones as $instalacion): ?>                     
                          <option value="<?php echo $instalacion['idInstalacion']; ?>"><?php echo $instalacion['Nombre']; ?></option>                      
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
  $(document).on('click', '.btn-ActualizarEstacionTrabajo', function() {
    
    $('#updidEstacion_Trabajo').val($(this).attr('idEstacion_Trabajo'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updInstalacion_id').val($(this).attr('Instalacion_id'));
    $('#updDescripcion').val($(this).attr('Descripcion'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarEstacionTrabajo', function() {
    idEstacion_Trabajo=$(this).attr('idEstacion_Trabajo');
    Swal.fire({
      title: '¿Desea eliminar la Estación de Trabajo?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=EstacionTrabajo&a=Eliminar&idEstacion_Trabajo="+idEstacion_Trabajo; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




