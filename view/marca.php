<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Marcas</h4>
                  <p class="card-description">
                    Listado de los Marcas de los Dispositivos.
                  </p>
                  <div class="table-responsive">
                    <?php  $marcas = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Marca</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($marcas as $marca): ?>
                      <tr>
                        <td><?php echo $marca['idMarca']; ?></td>
                        <td><?php echo $marca['Nombre']; ?></td>
                        <?php if ($marca['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarMarca" idMarca="<?php echo $marca['idMarca']; ?>" Nombre="<?php echo $marca['Nombre']; ?>" Descripcion="<?php echo $marca['Descripcion']; ?>" Estado="<?php echo $marca['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarMarca" idMarca="<?php echo $marca['idMarca']; ?>"><i class="ti-eraser"></i></button>                        
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
                  <h4 class="card-title">Registrar Marca</h4>
                  <form class="forms-sample" action="?c=Marca&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Marca</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre"  placeholder="Marca" required>
                    </div>
                    <div class="form-group">
                      <label for="Descripcion" class="col-sm-12 col-form-label">Descripción</label>
                        <input type="text" class="form-control" id="Descripcion" name="Descripcion"  placeholder="Descripcion" required>
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Registrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
                
              <div class="card" style="margin-top: 2em;">
                <div class="card-body">
                  <h4 class="card-title">Actualizar Marca</h4>
                  <form class="forms-sample" action="?c=Marca&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidMarca" class="col-sm-12 col-form-label">Id Sede</label>
                        <input type="text" class="form-control" id="updidMarca" name="idMarca"  placeholder="idMarca" required readonly>
                    </div>
                    <div class="form-group">
                      <label for="updNombre" class="col-sm-12 col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="updNombre" name="Nombre"  placeholder="Nombre Marca" required>
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
  $(document).on('click', '.btn-ActualizarMarca', function() {
    
    $('#updidMarca').val($(this).attr('idMarca'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updDescripcion').val($(this).attr('Descripcion'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarMarca', function() {
    idMarca=$(this).attr('idMarca');
    Swal.fire({
      title: '¿Desea eliminar esta Marca?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Marca&a=Eliminar&idMarca="+idMarca; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




