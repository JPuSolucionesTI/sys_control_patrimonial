<?php 
require_once 'controller/departamento.controller.php'; 
$departamento = new DepartamentoController; ?>

<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Areas</h4>
                  <p class="card-description">
                    Listado de los Areas de la Empresa.
                  </p>
                  <div class="table-responsive">
                    <?php  $areas = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Area</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($areas as $area): ?>
                      <tr>
                        <td><?php echo $area['idArea']; ?></td>
                        <td><?php echo $area['Nombre']; ?></td>
                        <?php if ($area['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarArea" idArea="<?php echo $area['idArea']; ?>" Nombre="<?php echo $area['Nombre']; ?>" Departamento_id="<?php echo $area['Departamento_id']; ?>" Estado="<?php echo $area['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarArea" idArea="<?php echo $area['idArea']; ?>"><i class="ti-eraser"></i></button>                         
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
                  <h4 class="card-title">Registrar Area</h4>
                  <form class="forms-sample" action="?c=Area&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Departamento_id" class="col-sm-12 col-form-label">Departamento</label>
                      <select class="form-control" id="Departamento_id" name="Departamento_id"  required>
                        <option value="0">-- Seleccione Departamento --</option>       
                        <?php $departamentos = $departamento->Listar(); ?>
                        <?php foreach ($departamentos as $departamento): ?>                     
                          <option value="<?php echo $departamento['idDepartamento']; ?>"><?php echo $departamento['Nombre']; ?></option>                      
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
                  <h4 class="card-title">Actualizar Area</h4>
                  <form class="forms-sample" action="?c=Area&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidArea" class="col-sm-12 col-form-label">Id Area</label>
                        <input type="text" class="form-control" id="updidArea" name="idArea"  placeholder="Are" required readonly>
                    </div>

                    <div class="form-group">
                      <label for="updDepartamento_id" class="col-sm-12 col-form-label">Departamento</label>
                      <select class="form-control" id="updDepartamento_id" name="Departamento_id"  required>
                        <option value="0">-- Seleccione Departamento --</option>       
                        
                        <?php foreach ($departamentos as $departamento): ?>                     
                          <option value="<?php echo $departamento['idDepartamento']; ?>"><?php echo $departamento['Nombre']; ?></option>                      
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
  $(document).on('click', '.btn-ActualizarArea', function() {
    
    $('#updidArea').val($(this).attr('idArea'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updDepartamento_id').val($(this).attr('Departamento_id'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarArea', function() {
    idArea=$(this).attr('idArea');
    Swal.fire({
      title: '¿Desea eliminar el Area?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Area&a=Eliminar&idArea="+idArea; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




