@include('plantillas.menu_header')
<meta name="csrf-token" content="{{ csrf_token() }}">


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
                          <h4 class="card-title" id="basic-layout-form-center">Agregar datos</h4>
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
                                <h4 class="card-title">Administradores</h4>
                            </div>
                            
                            <div class="card">
                                <div class="card-body">
                                    <table class="table" id="tabla">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Imagen</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Acciones</th>
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


    <script>
        $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $(document).ready(function () {
            MostrarProyectos();
        });

        function MostrarProyectos() {
            $.ajax({
                type:"ajax",
                method:"get",
                url:"MostrarPro",
                async:false,
                dataType:'html',
                        success: function(response){
                            console.log(response);

                            // var tabla;
                            // // var url;
                            for (let index = 0; index < response.length; index++) {
                              console.log(response[index].PROYECTOS_TITULO);
                            //   // url[index] = response[index].PROYECTOS_IMAGEN;
                            //     // url[index] = '{{ URL::asset('+response[index].PROYECTOS_IMAGEN+') }}'
                            //     tabla+='<tr><th scope="row">'+response[index].PROYECTOS_ID+'</th> <td>'
                            //     +response[index].PROYECTOS_TITULO+'</td> <td>'
                            //     +response[index].PROYECTOS_DESCRIPCION+'</td> <td>'
                            //     // +response[index].USUARIOS_ROL+'</td> <td>'
                            //     +'<img class="card-img-top border" style="width:200px; height:150px;"  src="'+response[index].PROYECTOS_IMAGEN+'" alt=""> </td> <td>'
                            //     +'<a href="javascript:;" style="width: 30%;" onclick="EditarAdmin('+response[index].PROYECTOS_ID+')" class="btn btn-block btn-warning" data="'+response[index].PROYECTOS_ID+'"><i class="fa fa-fw fa-refresh"></i></a>'
                            //     +'<a href="javascript:;" style="width: 30%;" onclick="Confirmar('+response[index].PROYECTOS_ID+')" class="btn -blobtnck btn-danger" data="'+response[index].PROYECTOS_ID+'"><i class="fa fa-fw fa-remove"></i></a>'
                            //     +'</td></tr>';
                            }

                            
                            $('#contenido').html(response);
                        },
                    beforeSend:function(){},
                    error:function(objXMLHttpRequest){
                        $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow'); 
                    }
                });
        }

        // guardar los proyectos
        $(document).ready(function () {
            $("#eviarAjax").click(function (event) {            
                var formulario = $("#formulario");
                var formData = new FormData($("#formulario")[0]);
                // var files = $('#image')[0].files[0];
                // formData.append('file',files);

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
                            MostrarProyectos();

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

        


    </script>