@include('plantillas.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN : Body-->
<body data-col="1-column" class=" 1-column  blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper nav-collapsed menu-collapsed">
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!--Login Page Starts-->
<section id="login">
  <div class="container-fluid">
    <div class="row full-height-vh m-0">
      <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="card">
          <div class="card-content">
            <div class="card-body login-img">
              <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none py-2 text-center align-middle">
                  <img src="app-assets/img/gallery/login.png" alt="" class="img-fluid mt-5" width="400" height="230">
                </div>
                
                    <div class="col-lg-6 col-md-12 bg-white px-4 pt-3">
                      <form action="IniciasSession" method="POST" enctype="multipart/form-data">
                      <h4 class="mb-2 card-title">Login</h4>
                      <p class="card-text mb-3">
                        Welcome back, please login to your account.
                      </p>
                      <input type="text" id="usuario" name="usuario" class="form-control mb-3"  placeholder="Username" required/>
                      <input type="password" id="password" name="password" class="form-control mb-1"  placeholder="Password" required/>
                      <div class="d-flex justify-content-between mt-2">
                        
                        
                      </div>
                      <br>
                      <div class="fg-actions d-flex justify-content-between">
                        
                        <div class="recover-pass" >
                          <button  class="btn btn-primary" type="button" onclick="SesionIniciar()">
                            <a  class="text-decoration-none text-white">Login</a>
                          </button>
                        </div>
                      </div>
                
                        <hr class="m-0">
                        <div class="d-flex justify-content-between mt-3">
                            <div class="option-login">
                              <h6 class="text-decoration-none text-primary">Or Login With</h6>
                            </div>
                            <div class="social-login-options">
                              <a class="btn btn-social-icon mr-2 btn-facebook">
                                <span class="fa fa-facebook"></span>
                              </a>
                              <a class="btn btn-social-icon mr-2 btn-twitter">
                                <span class="fa fa-twitter"></span>
                              </a>
                            </div>
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
</section>
<!--Login Page Ends-->

          </div>
        </div>
        <!-- END : End Main Content-->
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

@include('plantillas.footer')

<script>
  $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


  function SesionIniciar() {
    var usuario = document.getElementById('usuario').value;
    var password = document.getElementById('password').value;
    // console.log(password);
    if(usuario == null || usuario == '') {
            swal(
                      'Campo vacio',
                      'Por favor ingresa tu usuario!',
                      'warning'
                   )
        }else if(password == null || password == '') {
            swal(
                      'Campo vacio',
                      'Por favor ingrese su contraseña!',
                      'warning'
                   )
        }else {
          $.ajax({
                //async:true,
                cache:false,
                dataType:"json",
                type: 'POST',
                url:'IniciasSession',
                data: {usuario:usuario, password:password},
                success: function(response){
                  if(response.arreglo==1) {
                        swal(
                            'Correcto',
                            'Iniciando sesion...!',
                            'success'
                          )
                      setTimeout(function(){window.location.href='{{route("principal")}}'; }, 2000);
                  }else{
                        swal(
                              'Error!',
                              'Usuario o contraseña incorrectos',
                              'error'
                            )
                  }
                
                },
                beforeSend:function(){},
                error:function(objXMLHttpRequest){}
            });
        }

  }
</script>