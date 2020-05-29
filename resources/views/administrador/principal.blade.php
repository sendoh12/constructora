@include('plantillas.menu_header')
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="main-panel">
    <!-- BEGIN : Main Content-->
    <div class="main-content">
      <div class="content-wrapper"><!-- Basic form layout section start -->
        <div class="row">
            <div class="col-12">
            <div class="content-header">Sección de administradores</div>
            </div>
        </div>

        <div class="alert alert-danger" id="error" role="alert" style="display:none;">
        </div>
        <div class="alert alert-primary" id="buena" role="alert" style="display:none;">
        </div>

        <section id="extended">
            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Administradores</h4>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="tabla">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Nombre de usuario</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Aciones</th>
                                    </tr>
                                </thead>
                                <tbody id="contenido">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                   
                
                </div>
            </div>
            </div>
        </section>
        <!--Extended Table Ends-->

        

    </div>
</div>
</div>





@include('plantillas.footer')

<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
      <!-- Modal -->
      <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel4">Editar Usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form class="form" method="POST" action="RegistrarUsuario">
                @csrf
                <div class="modal-body">
                        
                    
                    <div class="form-group">
                        <label for="eventInput1">Nombre</label>
                        <input type="text" id="nombre" class="form-control" name="nombre" value="">
                    </div>

                    <div class="form-group">
                        <label for="eventInput2">Usuario</label>
                        <input type="text" id="usuario" class="form-control" name="usuario" value="">
                    </div>

                    <div class="form-group">
                        <label for="eventInput3">Constraseña</label>
                        <input type="password" id="password" class="form-control" name="password" value="">
                        <input type="hidden" name="id_usuario" id="id_usuario">
                    </div>

                    <div class="form-group">
                        <label for="eventInput4">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            {{-- @foreach ($roles as $item)
                                <option value="{{$item->ROLES_ID}}">{{$item->ROLES_NOMBRES}}</option>
                                
                            @endforeach --}}

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-primary" onclick="UpdateUsers()">Guardar cambios</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
      <!-- Modal -->
      
      <div class="modal fade text-left" id="EliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel4">Seguro que deseas eliminar usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-outline-primary" onclick="eliminar()">Eliminar</button>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<script>
    $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $(document).ready(function () {
        TaerUsuarios();
    });

      function TaerUsuarios() {
        $.ajax({
            type:"ajax",
            method:"get",
            url:"TraerAdmins",
            async:false,
            dataType:'json',
                    success: function(response){
                        console.log(response);

                        var tabla;
                        for (let index = 0; index < response.usuarios.length; index++) {
                            tabla+='<tr><th scope="row">'+response.usuarios[index].USUARIOS_ID+'</th> <td>'
                            +response.usuarios[index].USUARIOS_NOMBRE+'</td> <td>'
                            +response.usuarios[index].USUARIOS_USUARIO+'</td> <td>'
                            +response.usuarios[index].USUARIOS_ROL+'</td> <td>'
                            +'<a href="javascript:;" style="width: 30%;" onclick="EditarAdmin('+response.usuarios[index].USUARIOS_ID+')" class="btn btn-block btn-warning" data="'+response.usuarios[index].USUARIOS_ID+'"><i class="fa fa-fw fa-refresh"></i></a>'
                            +'<a href="javascript:;" style="width: 30%;" onclick="Confirmar('+response.usuarios[index].USUARIOS_ID+')" class="btn -blobtnck btn-danger" data="'+response.usuarios[index].USUARIOS_ID+'"><i class="fa fa-fw fa-remove"></i></a>'
                            +'</td></tr>';
                        }

                        for (let i = 0; i < response.roles.length; i++) {

                            document.getElementById("rol").innerHTML += "<option value='"+response.roles[i].ROLES_ID+"'>"
                                                                +response.roles[i].ROLES_NOMBRES+
                                                                        "</option>";

                        }
                        $('#contenido').html(tabla);
                    },
                beforeSend:function(){},
                error:function(objXMLHttpRequest){
                    $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow'); 
                }
            });
      }

      //boton para que aparezca el modal de editar
      function EditarAdmin(id) {
            console.log(id);

            $.ajax({
                //async:true,
                cache:false,
                dataType:"json",
                type: 'POST',
                url:'UsuariosId',
                data: {id_usuario:id},
                success: function(response){
                    $("#id_usuario").val(response.id);
                    $("#nombre").val(response.nombre);
                    $("#usuario").val(response.usuario);
                    // $("#password").val(response.contraseña);
                    
                
                },
                beforeSend:function(){},
                error:function(objXMLHttpRequest){
 
                }
            });
            $('#backdrop').modal('show');
      }


      //Boton de actualizar
      function UpdateUsers() {
        var id_usuario = document.getElementById('id_usuario').value;
        var nombre = document.getElementById('nombre').value;
        var usuario = document.getElementById('usuario').value;
        var password = document.getElementById('password').value;
        var rol = document.getElementById('rol').value;
        
        console.log(nombre);
        console.log(usuario);
        console.log(password);
        console.log(rol);

        $.ajax({
                //async:true,
                cache:false,
                dataType:"json",
                type: 'POST',
                url:'UpdateUser',
                data: {id_usuario:id_usuario, nombre:nombre, usuario:usuario, password:password, rol:rol},
                success: function(response){
                    if(response.arreglo==1){
                            $("#buena").html("Se Actualizo correctamente").fadeIn().delay(4000).fadeOut('snow');
                            $('#backdrop').modal('hide'); 
                            document.getElementById('password').value = '';
                            TaerUsuarios();

                    }else{
                        $('#backdrop').modal('hide');
                        $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                    }
                    
                
                },
                beforeSend:function(){},
                error:function(objXMLHttpRequest){
                    $('#backdrop').modal('hide');
                    $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                }
        });
      }


    var global;
    function Confirmar(id) {
        $('#EliminarUsuario').modal('show');
        global = id;
        console.log(global);
    }

    function eliminar() {
        var id = global

        $.ajax({
                //async:true,
                cache:false,
                dataType:"json",
                type: 'POST',
                url:'EliminarAdministrador',
                data: {id_usuario:id},
                success: function(response){
                    if(response.arreglo==1){
                            $("#buena").html("Se elimino correctamente").fadeIn().delay(4000).fadeOut('snow');
                            $('#EliminarUsuario').modal('hide'); 
                            TaerUsuarios();

                    }else{
                        $('#EliminarUsuario').modal('hide');
                        $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                    }
                    
                
                },
                beforeSend:function(){},
                error:function(objXMLHttpRequest){
                    $('#EliminarUsuario').modal('hide');
                    $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                }
            });
    }
</script>