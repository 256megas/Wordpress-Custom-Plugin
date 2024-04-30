jQuery(document).ready(function($){

    $('#btnNuevaEncuesta').click(function(){
        console.log("Nueva encuesta");  
        $('#modalNuevaEncuesta').modal("show"); 
    });

    var numPregunta=1;
    $('#addPregunta').click(function(e){
        console.log("Nueva pregunta");  
        numPregunta++;
        lineaNueva='<tr>'; 
        lineaNueva+='<td>'; 
        lineaNueva+='<label id="row'+numPregunta+'" for="txtNombre" class="col-form-label" style="margin-right:5px">Pregunta '+numPregunta+'</label>'; 
        lineaNueva+='</td>'; 
        lineaNueva+='<td>'; 
        lineaNueva+='<input type="text" name="name[]" id="name" class="form-control name_list">'; 
        lineaNueva+='</td>'; 
        lineaNueva+='<td>'; 
        lineaNueva+='<button name="remove" id="id="boton'+numPregunta+'"" class="btn btn-danger" style="margin-left:15px">X</button>'; 
        lineaNueva+='</td>'; 
        lineaNueva+='</tr>'; 
        $('#camposdinamicos').append(lineaNueva);
        e.preventDefault();
        return false;
    });


});