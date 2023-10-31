<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Proveedores</h4>
                  <p class="card-description">
                    Listado de los proveedores de los Dispositivos.
                  </p>
                  <div class="table-responsive">
                    <?php  $proveedores = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Documento">Documento</th>
                        <th data-field="Nombre">Proveedor</th>
                        <th data-field="Correo">Correo</th>
                        <th data-field="Telefono">Telefono</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($proveedores as $proveedor): ?>
                      <tr>
                        <td><?php echo $proveedor['idProveedor']; ?></td>
                        <td><?php echo $proveedor['Documento']; ?></td>
                        <td><?php echo $proveedor['Nombre']; ?></td>
                        <td><?php echo $proveedor['Correo']; ?></td>
                        <td><?php echo $proveedor['Telefono']; ?></td>
                        <?php if ($proveedor['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarProveedor" idProveedor="<?php echo $proveedor['idProveedor']; ?>" TipoDocumento="<?php echo $proveedor['TipoDocumento']; ?>"  Documento="<?php echo $proveedor['Documento']; ?>" Nombre="<?php echo $proveedor['Nombre']; ?>" Telefono="<?php echo $proveedor['Telefono']; ?>" Correo="<?php echo $proveedor['Correo']; ?>" Direccion="<?php echo $proveedor['Direccion']; ?>"  Nombre_Contacto="<?php echo $proveedor['Nombre_Contacto']; ?>"   Telefono_Contacto="<?php echo $proveedor['Telefono_Contacto']; ?>" Estado="<?php echo $proveedor['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarProveedor" idProveedor="<?php echo $proveedor['idProveedor']; ?>"><i class="ti-eraser"></i></button>                        
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
                  <h4 class="card-title">Registrar Proveedor</h4>
                  <form class="forms-sample" action="?c=Proveedor&a=Registrar" method="post" enctype="multipart/form-data" role="form">

                    <div class="form-group">
                      <label for="TipoDocumento" class="col-sm-12 col-form-label">Tipo Documento</label>
                      <select class="form-control" id="TipoDocumento" name="TipoDocumento"  required>
                        <option value="DNI">DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="CEX">CEX</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Documento" class="col-sm-12 col-form-label">Documento</label>
                        <input type="text" class="form-control" id="Documento" name="Documento"  placeholder="Documento" required>
                    </div> 
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Proveedor</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre"  placeholder="Proveedor" required>
                    </div>                    
                    <div class="form-group">
                      <label for="Telefono" class="col-sm-12 col-form-label">Telefono</label>
                        <input type="text" class="form-control" id="Telefono" name="Telefono"  placeholder="Telefono" required>
                    </div>
                    <div class="form-group">
                      <label for="Correo" class="col-sm-12 col-form-label">Correo</label>
                        <input type="text" class="form-control" id="Correo" name="Correo"  placeholder="Correo" required>
                    </div>
                    <div class="form-group">
                      <label for="Direccion" class="col-sm-12 col-form-label">Direccion</label>
                        <input type="text" class="form-control" id="Direccion" name="Direccion"  placeholder="Direccion" required>
                    </div>
                    <div class="form-group">
                      <label for="Nombre_Contacto" class="col-sm-12 col-form-label">Nombre Contacto</label>
                        <input type="text" class="form-control" id="Nombre_Contacto" name="Nombre_Contacto"  placeholder="Nombre_Contacto" required>
                    </div>
                    <div class="form-group">
                      <label for="Telefono_Contacto" class="col-sm-12 col-form-label">Telefono Contacto</label>
                        <input type="text" class="form-control" id="Telefono_Contacto" name="Telefono_Contacto"  placeholder="Telefono Contacto" required>
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Registrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
                
              <div class="card" style="margin-top: 2em;">
                <div class="card-body">
                  <h4 class="card-title">Actualizar Proveedor</h4>
                  <form class="forms-sample" action="?c=Proveedor&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidProveedor" class="col-sm-12 col-form-label">Id Proveedor</label>
                        <input type="text" class="form-control" id="updidProveedor" name="idProveedor"  placeholder="idProveedor" required readonly>
                    </div>

                    <div class="form-group">
                      <label for="updTipoDocumento" class="col-sm-12 col-form-label">Tipo Documento</label>
                      <select class="form-control" id="updTipoDocumento" name="TipoDocumento"  required>
                        <option value="DNI">DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="CEX">CEX</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="updDocumento" class="col-sm-12 col-form-label">Documento</label>
                        <input type="text" class="form-control" id="updDocumento" name="Documento"  placeholder="Documento" required>
                    </div> 
                    <div class="form-group">
                      <label for="updNombre" class="col-sm-12 col-form-label">Proveedor</label>
                        <input type="text" class="form-control" id="updNombre" name="Nombre"  placeholder="Categoria" required>
                    </div>                    
                    <div class="form-group">
                      <label for="updTelefono" class="col-sm-12 col-form-label">Telefono</label>
                        <input type="text" class="form-control" id="updTelefono" name="Telefono"  placeholder="Telefono" required>
                    </div>
                    <div class="form-group">
                      <label for="updCorreo" class="col-sm-12 col-form-label">Correo</label>
                        <input type="text" class="form-control" id="updCorreo" name="Correo"  placeholder="Correo" required>
                    </div>
                    <div class="form-group">
                      <label for="updDireccion" class="col-sm-12 col-form-label">Direccion</label>
                        <input type="text" class="form-control" id="updDireccion" name="Direccion"  placeholder="Direccion" required>
                    </div>
                    <div class="form-group">
                      <label for="updNombre_Contacto" class="col-sm-12 col-form-label">Nombre_Contacto</label>
                        <input type="text" class="form-control" id="updNombre_Contacto" name="Nombre_Contacto"  placeholder="Nombre_Contacto" required>
                    </div>
                    <div class="form-group">
                      <label for="updTelefono_Contacto" class="col-sm-12 col-form-label">Telefono Contacto</label>
                        <input type="text" class="form-control" id="updTelefono_Contacto" name="Telefono_Contacto"  placeholder="Telefono Contacto" required>
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
  $(document).on('click', '.btn-ActualizarProveedor', function() {

    $('#updidProveedor').val($(this).attr('idProveedor'));
    $('#updTipoDocumento').val($(this).attr('TipoDocumento'));
    $('#updDocumento').val($(this).attr('Documento'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updTelefono').val($(this).attr('Telefono'));
    $('#updCorreo').val($(this).attr('Correo'));
    $('#updDireccion').val($(this).attr('Direccion'));
    $('#updNombre_Contacto').val($(this).attr('Nombre_Contacto'));
    $('#updTelefono_Contacto').val($(this).attr('Telefono_Contacto'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updTipoDocumento').focus();
  });

  $(document).on('click', '.btn-EliminarProveedor', function() {
    idProveedor=$(this).attr('idProveedor');
    Swal.fire({
      title: '¿Desea eliminar el Proveedor?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Proveedor&a=Eliminar&idProveedor="+idProveedor; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




