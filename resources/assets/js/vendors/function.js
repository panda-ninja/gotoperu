/**
 * Created by Sigma on 12/04/2017.
<<<<<<< HEAD
 */
//sortable itinerary
$(function () {
    $(".grid .grid-lobo").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'placeholder',
        forceHelperSize: true
    });
});

//-- FREDDY

function mostrarItinerarios() {
    var destinos='';
    $("input[name=destinos]").each(function (index) {
        if($(this).is(':checked')){
            destinos+=$(this).val()+'_';
        }
    });

    destinos=destinos.substring(0,destinos.length-1);
    $("#lista_itinerarios").html('<div class="progress">'+
        '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">'+
        '<span class="sr-only">45% Complete</span>'+
        '</div>'+
        '</div>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/mostrar_itinerario', 'destinos='+destinos, function(data) {
        $("#lista_itinerarios").html(data);

    }).fail(function (data) {
        $("#lista_itinerarios").html('');
        console.log('error: '+data);
    });
}
var total_Itinerarios=0;
function Pasar_datos(){
    var itinerario='';
    $("input[name=itinerarios]").each(function (index) {
        if($(this).is(':checked')){
            total_Itinerarios++;
            itinerario=$(this).val().split('_');
            var servicios=itinerario[4].split('*');
            var iti_temp='';
                iti_temp+='<div class="box-sortable margin-bottom-10">'+
                '<a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample_'+itinerario[0]+'" aria-expanded="false" aria-controls="collapseExample">'+
                '<b>Dia '+total_Itinerarios+':</b> '+itinerario[1]+
            '</a>'+
        '<span class="label label-success pull-right">($'+itinerario[3]+'.00)</span>'+
            '<div class="collapse clearfix" id="collapseExample_'+itinerario[0]+'">'+
                '<div class="col-md-12"><input type="hidden" name="itinerario" value="'+itinerario[0]+'">'+
                    itinerario[2]+
            '<h5><b>Services</b></h5>'+
            '<table class="table table-condensed table-striped">'+
                '<thead>'+
                '<tr class="bg-grey-goto text-white">'+
                '<th colspan="2">Concepts</th>'+
                '<th>Prices</th>'+
                '<th></th>'+
                '</tr>'+
                '</thead>'+
                '<tbody>';
                var servicios_='';
                $.each(servicios, function( key, value ) {
                    var serv=value.split('/');
                    iti_temp+='<tr><td><input type="hidden" name="iti_servicios_'+itinerario[0]+'" value="'+value+'">'+serv[0]+'</td>'+
                                '<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>'+
                                '<td>'+serv[1]+'</td>'+
                                '<td><a href="#!" class="text-16 text-danger" onclick="eliminar_iti_servicio()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>'+
                            '</tr>';
                });
                // console.log('servicios:');

            iti_temp+=''+
                '<tr>'+
                '<td class="" colspan="4">'+
                '<a href="#add-services'+itinerario[0]+'" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>'+
                '<div class="collapse" id="add-services'+itinerario[0]+'">'+
                '<div class="row margin-top-10">'+
                '<div class="col-md-6">'+
                '<div class="form-group">'+
                '<input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">'+
                '</div>'+
                '</div>'+
                '<div class="col-md-4 row">'+
                '<div class="form-group">'+
                '<input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">'+
                '</div>'+
                '</div>'+
                '<div class="col-md-2">'+
                '<div class="form-group">'+
                '<a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</td>'+
                '</tr>'+
                '</tbody>'+
                '</table>'+
                '</div>'+
                '</div>'+
                '</div>';

            $('#Lista_itinerario_g').add(iti_temp);
            iti_temp='';
            // destinos+=$(this).val()+'_';
        }
    });

}
