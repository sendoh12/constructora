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

            </div>
        </div>
    </div>
</div>




@include('plantillas.footer')
