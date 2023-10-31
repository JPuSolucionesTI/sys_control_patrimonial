<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sedes</h4>
                  <p class="card-description">
                    Listado de los Sedes de la Empresa.
                  </p>
                  <div class="table-responsive">
                    <?php  $sedes = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Sede</th>
                        <th data-field="Direccion">Dirección</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($sedes as $sede): ?>
                      <tr>
                        <td><?php echo $sede['idSede']; ?></td>
                        <td><?php echo $sede['Nombre']; ?></td>
                        <td><?php echo $sede['Direccion']; ?></td>
                        <?php if ($sede['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarSede" idSede="<?php echo $sede['idSede']; ?>" Nombre="<?php echo $sede['Nombre']; ?>" Direccion="<?php echo $sede['Direccion']; ?>" Estado="<?php echo $departamento['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarSede" idSede="<?php echo $sede['idSede']; ?>"><i class="ti-eraser"></i></button>                         
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
                  <h4 class="card-title">Registrar Sede</h4>
                  <form class="forms-sample" action="?c=Sede&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Sede</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre"  placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                      <label for="Direccion" class="col-sm-12 col-form-label">Dirección</label>
                        <input type="text" class="form-control" id="Direccion" name="Direccion"  placeholder="Direccion" required>
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Registrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
                
              <div class="card" style="margin-top: 2em;">
                <div class="card-body">
                  <h4 class="card-title">Actualizar Sede</h4>
                  <form class="forms-sample" action="?c=Sede&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidSede" class="col-sm-12 col-form-label">Id Sede</label>
                        <input type="text" class="form-control" id="updidSede" name="idSede"  placeholder="idSede" required readonly>
                    </div>
                    <div class="form-group">
                      <label for="updNombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="updNombre" name="Nombre"  placeholder="Nombre Departamento" required>
                    </div>
                    <div class="form-group">
                      <label for="updDireccion" class="col-sm-12 col-form-label">Direccion</label>
                        <input type="text" class="form-control" id="updDireccion" name="Direccion"  placeholder="Direccion" required>
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
  $(document).on('click', '.btn-ActualizarSede', function() {
    
    $('#updidSede').val($(this).attr('idSede'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updDireccion').val($(this).attr('Direccion'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarSede', function() {
    idSede=$(this).attr('idSede');
    Swal.fire({
      title: '¿Desea eliminar este Sede?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Sede&a=Eliminar&idSede="+idSede; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




