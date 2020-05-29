@include('plantillas.menu_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-panel">
  <!-- BEGIN : Main Content-->
  <div class="main-content">
    <div class="content-wrapper"><!-- Basic form layout section start -->
    <div class="row match-height">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="basic-layout-form-center">Agregar usuario</h4>
          </div>
          <div class="card-content">
            <div class="px-3">

              <form class="form" method="POST" action="RegistrarUsuario">
                @csrf
                <div class="row justify-content-md-center">
                  <div class="col-md-6">
                    <div class="form-body">
                      <div class="form-group">
                        <label for="eventInput1">Nombre</label>
                        <input type="text" id="nombre" class="form-control" name="nombre">
                      </div>

                      <div class="form-group">
                        <label for="eventInput2">Usuario</label>
                        <input type="text" id="usuario" class="form-control" name="usuario">
                      </div>

                      <div class="form-group">
                        <label for="eventInput3">Constraseña</label>
                        <input type="password" id="password" class="form-control" name="password">
                        <input type="hidden" name="id_usuario" id="id_usuario">
                      </div>

                      <div class="form-group">
                        <label for="eventInput4">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            @foreach ($roles as $item)
                                <option value="{{$item->ROLES_ID}}">{{$item->ROLES_NOMBRES}}</option>
                                
                            @endforeach

                        </select>
                      </div>

                      

                    </div>
                  </div>
                </div>

                <div class="form-actions center">
                  <button type="button" class="btn btn-raised btn-warning mr-1">
                    <i class="ft-x"></i> Cancel
                  </button>
                  <button type="button" onclick="Registrar()" class="btn btn-raised btn-primary">
                    <i class="fa fa-check-square-o"></i> Guardar
                  </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



@include('plantillas.menu_footer')

<script>
    $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    function Registrar() {
    var nombre = document.getElementById('nombre').value;
    var usuario = document.getElementById('usuario').value;
    var password = document.getElementById('password').value;
    var rol = document.getElementById('rol').value;
    var id_usuario = document.getElementById('id_usuario').value;
    

    if(nombre == null || nombre == '') {
        swal(
                      'Campo vacio',
                      'No has llenado el campo de Nombre!',
                      'warning'
                   )
      }else if(usuario == null || usuario == '') {
        swal(
                      'Campo vacio',
                      'No has llenado el campo de usuario!',
                      'warning'
                   )
      }else if(password == null || password == '') {
        swal(
                      'Campo vacio',
                      'No has llenado el campo de Contraseña!',
                      'warning'
                   )
      }else if(nombre != null && usuario != null && password != null) {
                    
            $.ajax({
                //async:true,
                cache:false,
                dataType:"json",
                type: 'POST',
                url:'RegistrarUsuario',
                data: {id_usuario:id_usuario, nombre:nombre, usuario:usuario, password:password, rol:rol},
                success: function(response){
                  swal(
                        'Correcto',
                        'Guardando administrador...!',
                        'success'
                      )
                      setTimeout(function(){window.location.href='{{route("principal")}}'; }, 2000);
                
                },
                beforeSend:function(){},
                error:function(objXMLHttpRequest){
                  swal(
                        'Error!',
                        'Hubo un error',
                        'error'
                      )
                }
            });
        
      }else{
                    swal(
                        'Error!',
                        'Hubo un error',
                        'error'
                      )
      }



          

  }
</script>