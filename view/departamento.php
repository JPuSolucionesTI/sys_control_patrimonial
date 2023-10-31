<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Departamentos</h4>
                  <p class="card-description">
                    Listado de los Departamentos de la Empresa.
                  </p>
                  <div class="table-responsive">
                    <?php  $departamentos = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Departamento</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($departamentos as $departamento): ?>
                      <tr>
                        <td><?php echo $departamento['idDepartamento']; ?></td>
                        <td><?php echo $departamento['Nombre']; ?></td>
                        <?php if ($departamento['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarDepartamento" idDepartamento="<?php echo $departamento['idDepartamento']; ?>" Nombre="<?php echo $departamento['Nombre']; ?>" Abreviatura="<?php echo $departamento['Abreviatura']; ?>" Estado="<?php echo $departamento['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarDepartamento" idDepartamento="<?php echo $departamento['idDepartamento']; ?>"><i class="ti-eraser"></i></button>                         
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
                  <h4 class="card-title">Registrar Departamento</h4>
                  <form class="forms-sample" action="?c=Departamento&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre"  placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Abreviatura</label>
                        <input type="text" class="form-control" id="Abreviatura" name="Abreviatura"  placeholder="Abreviatura" required>
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Registrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
                
              <div class="card" style="margin-top: 2em;">
                <div class="card-body">
                  <h4 class="card-title">Actualizar Departamento</h4>
                  <form class="forms-sample" action="?c=Departamento&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidDepartamento" class="col-sm-12 col-form-label">Id Departamento</label>
                        <input type="text" class="form-control" id="updidDepartamento" name="idDepartamento"  placeholder="idDepartamento" required readonly>
                    </div>
                    <div class="form-group">
                      <label for="updNombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="updNombre" name="Nombre"  placeholder="Nombre Departamento" required>
                    </div>
                    <div class="form-group">
                      <label for="updAbreviatura" class="col-sm-12 col-form-label">Abreviatura</label>
                        <input type="text" class="form-control" id="updAbreviatura" name="Abreviatura"  placeholder="Abreviatura" required>
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
  $(document).on('click', '.btn-ActualizarDepartamento', function() {
    
    $('#updidDepartamento').val($(this).attr('idDepartamento'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updAbreviatura').val($(this).attr('Abreviatura'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarDepartamento', function() {
    idDepartamento=$(this).attr('idDepartamento');
    Swal.fire({
      title: '¿Desea eliminar este departamento?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Departamento&a=Eliminar&idDepartamento="+idDepartamento; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




