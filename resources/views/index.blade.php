@include('Plantillasfrom.Header')
@include('Plantillasfrom.Menu')
@include('Plantillasfrom.Seccion')
<div class="container">
  <div class="row">

        @forelse($lista as $itm)
            @if($itm->PROYECTO_TIPO=="¿Quiénes Somos?")
                <div class="col-sm-6">
                    <h3> {{$itm->PROYECTOS_TITULO}}</h3>
                    <p>{{$itm->PROYECTOS_DESCRIPCION}}</p>
                    <a href="index1" class="btn btn-full">Nosotros</a>
                </div>
                <div class="col-sm-6">
                    <img src="{{$itm->PROYECTOS_IMAGEN}}" class="img-thumbnail"  alt="" title="{{$itm->PROYECTOS_TITULO}}">
                </div>
            @endif
        
        @empty
            <div>
                <h1>No hay Proyectos</h1>       
            </div>
        @endforelse
        <div class="col-sm-12">
            <center><h1>Servicios</h1></center>
        </div>

        @forelse($lista as $value)
            @if($value->PROYECTO_TIPO=="Servicios")
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{$value->PROYECTOS_IMAGEN}}" class="img-thumbnail"  alt="" title="{{$value->PROYECTOS_TITULO}}">
                            <h5 class="card-title">{{$value->PROYECTOS_TITULO}}</h5>
                            <p class="card-text">{{$value->PROYECTOS_DESCRIPCION}}</p>
                            <a href="#" class="btn btn-full">Mas Informacion</a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
        @endforelse
        <div class="col-sm-12" style="bgcolor:lightyellow;">
            <center><h3>Contamos con la más amplia calificación técnica y especialización</h3>
                    <h5>Proporcionamos soluciones óptimas</h5> 
                    <a href="" class="btn btn-full">Contacto</a>
            </center>
        </div>
        <div class="col-sm-12">
            <center><h3>Clientes Que Confían En Nosotros</h3></center>
        </div>
  </div>
</div>
@include('Plantillasfrom.Endsccion')
@include('Plantillasfrom.Footer')
