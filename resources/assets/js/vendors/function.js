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
    var Itis_precio=0;
    $("input[name=itinerarios]").each(function (index) {
        if($(this).is(':checked')){
            total_Itinerarios++;
            itinerario=$(this).val().split('_');
            Itis_precio+=parseInt(itinerario[3]);
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

            $('#Lista_itinerario_g').append(iti_temp);
            iti_temp='';
            // destinos+=$(this).val()+'_';

        }
    });
    $('#totalItinerario').val(Itis_precio);
}

function cambiar_profit(tipo){
    var totalItinerario=parseInt($('#totalItinerario').val());
    var nroDiasItinerario=parseInt($('#txt_day').val());
    nroDiasItinerario=nroDiasItinerario-1;
    // console.log('totalItinerario:'+totalItinerario);
    // console.log('nroDiasItinerario:'+nroDiasItinerario);

    var profit_0=$('#profit_0').val();
    var profit_2=$('#profit_2').val();
    var profit_3=$('#profit_3').val();
    var profit_4=$('#profit_4').val();
    var profit_5=$('#profit_5').val();

    if(tipo==2){
        var vt2=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t2').val()));
        $('#amount_t2_c').val(vt2);
        vt2=Math.ceil(vt2+((vt2*profit_2)*0.01));
        $('#amount_t2_v').val(vt2);

        var vd2=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d2').val()));
        $('#amount_d2_c').val(vd2);
        vd2=Math.ceil(vd2+((vd2*profit_2)*0.01));
        $('#amount_d2_v').val(vd2);

        var vs2=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s2').val()));
        $('#amount_s2_c').val(vs2);
        vs2=Math.ceil(vs2+((vs2*profit_2)*0.01));
        $('#amount_s2_v').val(vs2);
    }
    if(tipo==3){
        var vt3=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t3').val()));
        $('#amount_t3_c').val(vt3);
        vt3=Math.ceil(vt3+((vt3*profit_3)*0.01));
        $('#amount_t3_v').val(vt3);

        var vd3=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d3').val()));
        $('#amount_d3_c').val(vd3);
        vd3=Math.ceil(vd3+((vd3*profit_3)*0.01));
        $('#amount_d3_v').val(vd3);

        var vs3=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s3').val()));
        $('#amount_s3_c').val(vs3);
        vs3=Math.ceil(vs3+((vs3*profit_3)*0.01));
        $('#amount_s3_v').val(vs3);
    }
    if(tipo==4){
        var vt4=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t4').val()));
        $('#amount_s4_c').val(vt4);
        vt4=Math.ceil(vt4+((vt4*profit_4)*0.01));
        $('#amount_t4_v').val(vt4);

        var vd4=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d4').val()));
        $('#amount_d4_c').val(vd4);
        vd4=Math.ceil(vd4+((vd4*profit_4)*0.01));
        $('#amount_d4_v').val(vd4);

        var vs4=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s4').val()));
        $('#amount_s4_c').val(vs4);
        vs4=Math.ceil(vs4+((vs4*profit_4)*0.01));
        $('#amount_s4_v').val(vs4);
    }
    if(tipo==5){
        var vt5=totalItinerario+(nroDiasItinerario*parseInt($('#amount_t5').val()));
        $('#amount_t5_c').val(vt5);
        vt5=Math.ceil(vt5+((vt5*profit_5)*0.01));
        $('#amount_t5_v').val(vt5);

        var vd5=totalItinerario+(nroDiasItinerario*parseInt($('#amount_d5').val()));
        $('#amount_d5_c').val(vd5);
        vd5=Math.ceil(vd5+((vd5*profit_5)*0.01));
        $('#amount_d5_v').val(vd5);

        var vs5=totalItinerario+(nroDiasItinerario*parseInt($('#amount_s5').val()));
        $('#amount_s5_c').val(vs5);
        vs5=Math.ceil(vs5+((vs5*profit_5)*0.01));
        $('#amount_s5_v').val(vs5);
    }
}
function cambiar_profit_total() {
    cambiar_profit(2);
    cambiar_profit(3);
    cambiar_profit(4);
    cambiar_profit(5);
}

/*== functions for destinations*/
function eliminar_destino(id,destino) {
    // alert('holaaa');
    // swal({
    //     title: 'MENSAJE DEL SISTEMA',
    //     text: "¿Estas seguro de eliminar el destino "+destino+"?",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes'
    // }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/destination/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_destinos_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });
    //
    // })
}