<div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Categorias</h4>
                  <p class="card-description">
                    Listado de los Categorias de los Dispositivos.
                  </p>
                  <div class="table-responsive">
                    <?php  $categorias = $this->Listar();  ?>
                  <table
                    data-toggle="table"
                    data-pagination="true"
                    data-search="true" class="table table-striped">
                    <thead>
                      <tr>
                        <th data-field="Id">Id</th>
                        <th data-field="Nombre">Categoria</th>
                        <th data-field="Abreviatura">Abreviatura</th>
                        <th data-field="Tipo_Categoria">Tipo</th>
                        <th data-field="Tipo_Administracion">Administracion</th>
                        <th data-field="Estado">Estado</th>
                        <th data-field="Acciones">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                      <tr>
                        <td><?php echo $categoria['idCategoria']; ?></td>
                        <td><?php echo $categoria['Nombre']; ?></td>
                        <td><?php echo $categoria['Abreviatura']; ?></td>
                        <td><?php echo $categoria['Tipo_Categoria']; ?></td>
                        <td><?php echo $categoria['Tipo_Administracion']; ?></td>
                        <?php if ($categoria['Estado']==1): ?>
                        <td class=""><label class="badge badge-success">Activo</label></td>
                        <?php else: ?>
                        <td class=""><label class="badge badge-danger">Inactivo</label></td>
                        <?php endif ?>
                        <td class="a_center">
                          <button type="button" class="btn btn-primary btn-sm btn-icon btn-ActualizarCategoria" idCategoria="<?php echo $categoria['idCategoria']; ?>" Nombre="<?php echo $categoria['Nombre']; ?>" Abreviatura="<?php echo $categoria['Abreviatura']; ?>" Descripcion="<?php echo $categoria['Descripcion']; ?>" Tipo_Categoria="<?php echo $categoria['Tipo_Categoria']; ?>"  Tipo_Administracion="<?php echo $categoria['Tipo_Administracion']; ?>" Estado="<?php echo $categoria['Estado']; ?>"><i class="ti-pencil-alt"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-icon btn-EliminarCategoria" idCategoria="<?php echo $categoria['idCategoria']; ?>"><i class="ti-eraser"></i></button>                        
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
                  <h4 class="card-title">Registrar Categoria</h4>
                  <form class="forms-sample" action="?c=Categoria&a=Registrar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="Nombre" class="col-sm-12 col-form-label">Categoria</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre"  placeholder="Categoria" required>
                    </div>                    
                    <div class="form-group">
                      <label for="Abreviatura" class="col-sm-12 col-form-label">Abreviatura</label>
                        <input type="text" class="form-control" id="Abreviatura" name="Abreviatura"  placeholder="Abreviatura" required>
                    </div>
                    <div class="form-group">
                      <label for="Descripcion" class="col-sm-12 col-form-label">Descripción</label>
                        <input type="text" class="form-control" id="Descripcion" name="Descripcion"  placeholder="Descripcion" required>
                    </div>
                    <div class="form-group">
                      <label for="Tipo_Categoria" class="col-sm-12 col-form-label">Tipo Categoria</label>
                      <select class="form-control" id="Tipo_Categoria" name="Tipo_Categoria"  required>
                        <option value="Linea blanca">Linea blanca</option>
                        <option value="Linea Mobiliario">Linea Mobiliario</option>
                        <option value="Equipos de computo">Equipos de computo</option>
                        <option value="Accesorios de computo">Accesorios de computo</option>
                        <option value="Equipos celulares">Equipos celulares</option>
                        <option value="Herramientas">Herramientas</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Tipo_Administracion" class="col-sm-12 col-form-label">Tipo Administracion</label>
                      <select class="form-control" id="Tipo_Administracion" name="Tipo_Administracion"  required>
                        <option value="Administración y Finanzas">Administración y Finanzas</option>
                        <option value="Tecnología de la Información">Tecnología de la Información</option>
                      </select>
                    </div>
                    <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Registrar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                  </form>
                </div>
              </div>
                
              <div class="card" style="margin-top: 2em;">
                <div class="card-body">
                  <h4 class="card-title">Actualizar Categoria</h4>
                  <form class="forms-sample" action="?c=Categoria&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                      <label for="updidCategoria" class="col-sm-12 col-form-label">Id Categoria</label>
                        <input type="text" class="form-control" id="updidCategoria" name="idCategoria"  placeholder="idCategoria" required readonly>
                    </div>
                    <div class="form-group">
                      <label for="updNombre" class="col-sm-12 col-form-label">Categoria</label>
                        <input type="text" class="form-control" id="updNombre" name="Nombre"  placeholder="Categoria" required>
                    </div>                    
                    <div class="form-group">
                      <label for="updAbreviatura" class="col-sm-12 col-form-label">Abreviatura</label>
                        <input type="text" class="form-control" id="updAbreviatura" name="Abreviatura"  placeholder="Abreviatura" required>
                    </div>
                    <div class="form-group">
                      <label for="updDescripcion" class="col-sm-12 col-form-label">Descripción</label>
                        <input type="text" class="form-control" id="updDescripcion" name="Descripcion"  placeholder="Descripcion" required>
                    </div>
                    <div class="form-group">
                      <label for="updTipo_Categoria" class="col-sm-12 col-form-label">Tipo Categoria</label>
                      <select class="form-control" id="updTipo_Categoria" name="Tipo_Categoria"  required>
                        <option value="Linea blanca">Linea blanca</option>
                        <option value="Linea Mobiliario">Linea Mobiliario</option>
                        <option value="Equipos de computo">Equipos de computo</option>
                        <option value="Accesorios de computo">Accesorios de computo</option>
                        <option value="Equipos celulares">Equipos celulares</option>
                        <option value="Herramientas">Herramientas</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="updTipo_Administracion" class="col-sm-12 col-form-label">Tipo Administracion</label>
                      <select class="form-control" id="updTipo_Administracion" name="Tipo_Administracion"  required>
                        <option value="Administración y Finanzas">Administración y Finanzas</option>
                        <option value="Tecnología de la Información">Tecnología de la Información</option>
                      </select>
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
  $(document).on('click', '.btn-ActualizarCategoria', function() {
    
    $('#updidCategoria').val($(this).attr('idCategoria'));
    $('#updNombre').val($(this).attr('Nombre'));
    $('#updAbreviatura').val($(this).attr('Abreviatura'));
    $('#updDescripcion').val($(this).attr('Descripcion'));
    $('#updTipo_Categoria').val($(this).attr('Tipo_Categoria'));
    $('#updTipo_Administracion').val($(this).attr('Tipo_Administracion'));
    $('#updEstado').val($(this).attr('Estado'));
    $('#updNombre').focus();
  });

  $(document).on('click', '.btn-EliminarCategoria', function() {
    idCategoria=$(this).attr('idCategoria');
    Swal.fire({
      title: '¿Desea eliminar la Categoria?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario hizo clic en "Sí"
        // Redirige al usuario a la URL deseada
        window.location.href = "?c=Categoria&a=Eliminar&idCategoria="+idCategoria; // Reemplaza 123 con el ID correcto
      } else {
        // El usuario hizo clic en "No" o cerró el cuadro de diálogo
        // Puedes realizar alguna otra acción si es necesario
        Swal.fire('Cancelado', '', 'info');
      }
    });
  });

});


  </script>




