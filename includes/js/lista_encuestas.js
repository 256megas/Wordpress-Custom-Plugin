jQuery(document).ready(function($){

    $('#btnNuevaEncuesta').click(function(){
        console.log("Nueva encuesta");  
        $('#modalNuevaEncuesta').modal("show"); 
    });

    var numPregunta=1;
    $('#addPregunta').click(function(e){
        console.log("Nueva pregunta");  
        numPregunta++;
        lineaNueva='<tr id="row'+numPregunta+'">'; 
        lineaNueva+='<td>'; 
        lineaNueva+='<label  for="txtNombre" class="col-form-label" style="margin-right:5px">Pregunta '+numPregunta+'</label>'; 
        lineaNueva+='</td>'; 
        lineaNueva+='<td>'; 
        lineaNueva+='<input type="text" name="name[]" id="name" class="form-control name_list">'; 
        lineaNueva+='</td>'; 
        lineaNueva+='<td>'; 
        lineaNueva+='<select name="type[]" id="type" class="form-control type_list" style="margin-right:5px">'; 
        lineaNueva+='<option value="yn" select>SI - NO</option>'; 
        lineaNueva+='<option value="range">Rando 0 - 5</option>'; 
        lineaNueva+='</select>'; 
        lineaNueva+='</td>'; 
        lineaNueva+='<td>'; 
        lineaNueva+='<button name="removePregunta" id="'+numPregunta+'" class="removePregunta btn btn-danger" style="margin-left:15px">X</button>'; 
        lineaNueva+='</td>'; 
        lineaNueva+='</tr>'; 
        $('#camposdinamicos').append(lineaNueva);
        e.preventDefault();
        return false;
    });

    
    $(document).on('click','.removePregunta',function(){    
        var button_id = $(this).attr('id');
        $("#row" +button_id+"").remove();
        console.log("borramos");
        
        return false;
    });


});