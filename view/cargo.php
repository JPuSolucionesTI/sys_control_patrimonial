<?php 
require_once 'controller/area.controller.php'; 
$area = new AreaController; ?>

<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cargos</h4>
                  <p class="card-description">
                    Listado de los Cargos de la Empresa.
                  </p>
                  <div class="table-responsive">
                    <?php  $cargos = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Cargo</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cargos as $cargo): ?>
                      <tr>
                        <td><?php echo $cargo['idCargo']; ?></td>
                        <td><?php echo $cargo['Nombre']; ?></td>
                        <?php if ($cargo['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarCargo" idCargo="<?php echo $cargo['idCargo']; ?>" Nombre="<?php echo $cargo['Nombre']; ?>" Area_id="<?php echo $cargo['Area_id']; ?>" Estado="<?php echo $cargo['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarCargo" idCargo="<?php echo $cargo['idCargo']; ?>"><i class="ti-eraser"></i></button>                         
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
                  <h4 class="card-title">Registrar Cargo</h4>
                  <form class="forms-sample" action="?c=Cargo&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Area_id" class="col-sm-12 col-form-label">Area</label>
                      <select class="form-control" id="Area_id" name="Area_id"  required>
                        <option value="0">-- Seleccione Areas --</option>       
                        <?php $areas = $area->Listar(); ?>
                        <?php foreach ($areas as $area): ?>                     
                          <option value="<?php echo $area['idArea']; ?>"><?php echo $area['Nombre']; ?></option>                      
                        <?php endforeach; ?>
                     </select>
                    </div>
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre"  placeholder="Nombre" required>
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Registrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
                
              <div class="card" style="margin-top: 2em;">
                <div class="card-body">
                  <h4 class="card-title">Actualizar Cargo</h4>
                  <form class="forms-sample" action="?c=Cargo&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidCargo" class="col-sm-12 col-form-label">Id Cargo</label>
                        <input type="text" class="form-control" id="updidCargo" name="idCargo"  placeholder="Are" required readonly>
                    </div>

                    <div class="form-group">
                      <label for="updArea_id" class="col-sm-12 col-form-label">Area</label>
                      <select class="form-control" id="updArea_id" name="Area_id"  required>
                        <option value="0">-- Seleccione Area --</option>       
                        
                        <?php foreach ($areas as $area): ?>                     
                          <option value="<?php echo $area['idArea']; ?>"><?php echo $area['Nombre']; ?></option>                      
                        <?php endforeach; ?>
                     </select>
                    </div>
                    <div class="form-group">
                      <label for="updNombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="updNombre" name="Nombre"  placeholder="Nombre Area" required>
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
  $(document).on('click', '.btn-ActualizarCargo', function() {
    
    $('#updidCargo').val($(this).attr('idCargo'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updArea_id').val($(this).attr('Area_id'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarCargo', function() {
    idCargo=$(this).attr('idCargo');
    Swal.fire({
      title: '¿Desea eliminar el Cargo?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Cargo&a=Eliminar&idCargo="+idCargo; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




