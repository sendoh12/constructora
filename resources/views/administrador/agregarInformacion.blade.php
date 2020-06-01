@include('plantillas.menu_header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="examen">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
            <div class="content-wrapper"><!-- Basic form layout section start -->
                
                <div class="alert alert-danger" id="error" role="alert" style="display:none;">
                </div>
                <div class="alert alert-primary" id="buena" role="alert" style="display:none;">
                </div>

                <div class="row match-height">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          
                          <h4 class="card-title" id="examen basic-layout-form-center">                            
                             @{{ message }}

                          </h4>
                          <br>
                        </div>
                        
                        <div class="card-content">
                          <div class="px-3">
              
                            <form class="form" method="POST" action="" id="formulario" enctype="multipart/form-data">
                              @csrf
                              <div class="row ">

                                <div class="col-md-4">
                                    <label for="file">Imagen</label>
                                    <input type="file" id="image" class="form-control" name="image">
                                  </div>


                                    <div class="col-md-4">
                                      <label for="eventInput1">Titulo</label>
                                      <input type="text" id="titulo" class="form-control" name="titulo">
                                    </div>
              
                                    <div class="col-md-4">
                                      <label for="eventInput2">Descripción</label>
                                      <textarea id="descripcion" rows="2" class="form-control square" name="descripcion"></textarea>
                                    </div>

                              </div>
              
                              <div class="form-actions left">
                                {{-- <button type="button" class="btn btn-raised btn-warning mr-1">
                                  <i class="ft-x"></i> Cancel
                                </button> --}}
                                <button type="button" id="eviarAjax" class="btn btn-raised btn-primary">
                                  <i class="fa fa-check-square-o"></i> Guardar
                                </button>
                                {{-- <button v-on:click.prevent="TraerDatos()">Mostrar</button> --}}
                              </div>
                            </form>
              
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  

                  <section id="extended">
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Proyectos</h4>
                            </div>
                            
                            <div class="card">
                                <div class="card-body">
                                    <table class="table" id="tabla">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Imagen</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenido">
                                            <tr v-for="(datos, index) in cards ">
                                              <td>@{{datos.PROYECTOS_ID}}</td>
                                              
                                              <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                      <img class="card-img-top " style="width:200px; height:120px;"  v-bind:src="datos.PROYECTOS_IMAGEN" alt="">

                                                    </div>
                                                    <div class="col-md-8">
                                                      <div class="row">
                                                        <div class="col-md-12">
                                                          <div class="col-md-6">
                                                            @{{datos.PROYECTOS_TITULO}}
                                                          </div>
                                                          <div class="col-md-6">
                                                            @{{datos.PROYECTOS_DESCRIPCION}}
                                                          </div>
                                                      </div>
                                                    </div>
                                              </div>
                                              </td>
                                              <td>
                                                <div class="row">
                                                  {{-- <div class="col-md-12"> --}}
                                                    <div class="col-md-8">
                                                      <a href="javascript:;" style="width: 100%;" v-on:click.prevent="EditarDatos(datos.PROYECTOS_ID)"  class="btn btn-block btn-warning"><i class="fa fa-fw fa-refresh"></i></a>

                                                    </div>
                                                    <div class="col-md-8">
                                                      <a href="javascript:;" style="width: 100%;" v-on:click.prevent="EliminarPro(datos.PROYECTOS_ID)"  class="btn -blobtnck btn-danger"><i class="fa fa-fw fa-remove"></i></a>

                                                    </div>
                                                    <div class="col-md-8">
                                                    <a href="javascript:;" v-on:click.prevent="InsertImage(datos.PROYECTOS_ID)" style="width: 100%;"  class="btn -blobtnck btn-primary"><i class="fa fa-fw fa-home"></i></a>
                                                    {{-- <a v-bind:href="AgregarImagenes/'+datos.PROYECTOS_ID" v-on:click.prevent="EliminarPro(datos.PROYECTOS_ID)" style="width: 100%;"  class="btn -blobtnck btn-primary"><i class="fa fa-fw fa-home"></i></a> --}}

                                                    </div>
                                                  {{-- </div> --}}
                                                </div>
                                              </td>

                                            </tr>
                                            
                                        
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


        <div class="modal" id="Editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Editar Proyectos</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>
              <form class="form" method="POST" action="" id="formModal" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div>
                        <fieldset class="form-group">
                          <label for="file">Imagen</label>
                            <input type="file" id="ImagenModal" class="form-control" name="ImagenModal">
      
                            <label for="eventInput1">Titulo</label>
                            <input type="text" id="tituloModal" class="form-control" name="tituloModal">
      
                            <label for="eventInput2">Descripción</label>
                            <textarea id="drscrModal" rows="2" class="form-control square" name="drscrModal"></textarea>
      
                        </fieldset>
                    </div>
                    <input type="hidden" name="idCard" id="idCard">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-primary" id="actualizarPro">Guardar</button>
                </div>
              </form>
          </div>
          </div>
        </div>

        {{-- modal para eliminar proyecto --}}
        <div class="modal" id="Eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Eliminar Proyectos</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>


                <div class="modal-body">
                    <div>
                        <fieldset class="form-group">
                          <label for="file">Seguro que deseas eliminar el proyecto</label>
                            
                        </fieldset>
                    </div>
                    <input type="hidden" name="idCard" id="idCard">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-primary" id="EliminarPro">Guardar</button>
                </div>
              </form>
          </div>
          </div>
        </div>

      </div>




@include('plantillas.footer')

    


    <script>
      var examen = new Vue({
        el: '#examen',
        data: {
          message: 'Agregar datos',
          cards:'',
          ids:'',
          eliminarPro:''
        },

        methods: {

          TraerDatos: function() {
              var url = 'MostrarPro';
              this.$http.get(url).then(response => {
                  this.cards = response.body;
              });
            
          },

          EditarDatos: function(id) {
            var url = 'ActualizarCards';
              axios.post(url, {id_cards:id},).then(response => {
                  $("#idCard").val(response.data[0].PROYECTOS_ID);
                  $("#tituloModal").val(response.data[0].PROYECTOS_TITULO);
                  $("#drscrModal").val(response.data[0].PROYECTOS_DESCRIPCION);
                  $("#drscrModal").val(response.data[0].PROYECTOS_DESCRIPCION);
              });
              $('#Editar').modal('show');
          },

          // var global = 0;
          EliminarPro: function(id) {
            this.eliminarPro = id;
            console.log(this.eliminarPro);
            $('#Eliminar').modal('show');
          },

          InsertImage:function(id) {
            var id_codi = btoa(id);
            console.log(id_codi);
            var url = '{{ route("AgregarImagenes", ":slug") }}';
            url = url.replace(':slug', id_codi);
            window.location.href=url;
				  },
        },

      })
    </script>

    <script>
        $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $(document).ready(function () {
            examen.TraerDatos();
        });

        // guardar los proyectos
        $(document).ready(function () {
            $("#eviarAjax").click(function (event) {    
                     
                var formulario = $("#formulario");
                var formData = new FormData($("#formulario")[0]);


                $.ajax({
                    url: "GuardarDatos",
                    // data: formulario.serialize(), 
                    method: "POST",
                    data: formData,
                    dataType:'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response){
                        if(response.arreglo==1){
                            $("#buena").html("Se guardo correctamente").fadeIn().delay(4000).fadeOut('snow');
                            examen.TraerDatos();
                            document.getElementById('image').value='';
                            document.getElementById('titulo').value='';
                            document.getElementById('descripcion').value='';

                        }else{
                            $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                            
                        }

                    },
                    beforeSend:function(){},
                    error:function(objXMLHttpRequest){
                        $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                        
                    }
                });
            });
        });


        //modal para editar
        $(document).ready(function () {
            $("#actualizarPro").click(function (event) {    
                var formData = new FormData($("#formModal")[0]);
                $.ajax({
                    url: "ProjecActualizar",
                    method: "POST",
                    data: formData,
                    dataType:'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response){
                        if(response.arreglo==1){
                            $("#buena").html("Se guardo correctamente").fadeIn().delay(4000).fadeOut('snow');
                            $('#Editar').modal('hide');
                            examen.TraerDatos();

                        }else{
                            $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                            $('#Editar').modal('hide');
                            
                        }

                    },
                    beforeSend:function(){},
                    error:function(objXMLHttpRequest){
                        $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                        $('#Editar').modal('hide');
                    }
                });
            });
        });

        

       


    </script>