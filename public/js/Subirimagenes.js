$(document).ready(function(){
    Image();
});


Image=()=>{
    var id=$('#idproyec').val();
    console.log(id);
    $.ajax({
        type:"ajax",
        method:"get",
        url:"/mostrarimagenes/"+id,
        async:'false',
        dataType:"json",
        success:function(itm)
        {
            console.log(itm);
            var img="";
            for (let index = 0; index < itm.length; index++) {
                img+= '<div><img src="'+itm[index].IMG+'" title="imagenes de una cotrucion" height="100px"/>'+itm[index].NOMBRE_IMG+'</div>';
                
            }
            $('#imagenes').html(img);
        },
        error:function(error){
            console.error("error");
        }        

    });
}


Subir=()=>{

 var formData= new FormData($("#subirimahen")[0]);
 $.ajax({
     type:'ajax',
     method:"post",
     url:"/subirimagenes",
     async:'false',
     dataType:'json',
     data:formData,
     processData: false,
     contentType: false,
     cache: false,
     success:function (itm) {
         if(itm==true){
            $("#buena").html("Se guardo correctamente").fadeIn().delay(4000).fadeOut('snow');
            Image();
         }else{
            $("#error").html("Ocurrio un error intente mas tarde o cumonicate con el administrador").fadeIn().delay(4000).fadeOut('snow');
                            
         }
     },
     error:function(error){
        $("#error").html("Ocurrio un error en el servidor").fadeIn().delay(4000).fadeOut('snow');
                            
     }
     
 });   
}