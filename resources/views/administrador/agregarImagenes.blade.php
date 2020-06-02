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

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Subir Imagenes</h5>
                        <h6>Selecione la imagenes con el orden que quiera que aparescan</h6>
                        <form id="subirimahen" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="idproyec"value="{{ $id }}">
                            <input type="file" name="imagen[]" id="imagen[]" multiple="">
                            <button type="button" onclick="Subir();">Enviar</button>
                        </form>  
                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <div id='imagenes'>

                        </div>
                    </div>
                </div>


            </div>
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
</script>
<script src="/js/Subirimagenes.js"></script>