<template>



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
                            <button type="button"  class="btn btn-raised btn-primary">
                                  <i class="fa fa-check-square-o"></i> Guardar
                                </button>

                        </div>
                    </div>
                    </div>
                </section>
                <!--Extended Table Ends-->
</template>

<script>
    
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }

    
</script>
