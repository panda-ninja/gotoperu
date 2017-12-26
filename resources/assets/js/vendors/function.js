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
var Itis_precio=0;
var nroPasajeros=2;
function Pasar_datos(){
    Itis_precio=parseFloat($('#totalItinerario').val());
    total_Itinerarios=$('#nroItinerario').val();
    var itinerario='';
    $("input[name=itinerarios]").each(function (index){
        if($(this).is(':checked')){
            $(this).prop("checked", "");
            total_Itinerarios++;
            itinerario=$(this).val().split('_');
            var precio_grupo=0;
            Itis_precio += parseFloat(itinerario[4]);
            console.log('Precios:'+Itis_precio);
            // if(parseInt(itinerario[4])==0) {
            //     Itis_precio += parseInt(itinerario[4]);
            //     precio_grupo=parseInt(itinerario[4]);
            // }
            // else if(parseInt(itinerario[4])==1){
            //     Itis_precio += Math.ceil(parseInt(itinerario[4])/nroPasajeros);
            //     precio_grupo=Math.ceil(parseInt(itinerario[4])/nroPasajeros);
            // }
            // console.log('cost: '+Itis_precio);
            var servicios=itinerario[5].split('*');
            $.each(servicios, function( key, value ) {
                var serv=value.split('//');
                var val_p_g=parseFloat(serv[1]);
                // if(serv[2]==1)
                //     val_p_g=parseInt(Math.ceil(serv[1]/nroPasajeros));
                // precio_grupo+=val_p_g;
            });
            var iti_temp='';
                iti_temp+='<div id="itis_'+itinerario[0]+'" class="box-sortable margin-bottom-10">'+
                '<input type="hidden" name="itinerarios_[]" id="itinerarios_'+itinerario[0]+'" value="'+itinerario[0]+'">'+
                '<a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample_'+itinerario[0]+'" aria-expanded="false" aria-controls="collapseExample">'+
                '<b>Dia '+total_Itinerarios+':</b> '+itinerario[2]+
            '</a>'+
        '<span class="label pull-right">' +
            '<a href="#!" class="text-16 text-danger" onclick="eliminar_iti('+itinerario[0]+','+itinerario[4]+')">' +
                '<i class="fa fa-times-circle" aria-hidden="true"></i>' +
            '</a>'+
        '</span>'+
        '<span class="label label-success pull-right">($'+itinerario[4]+')</span>'+
                    '<div class="collapse clearfix" id="collapseExample_'+itinerario[0]+'">'+
                '<div class="col-md-12"><input type="hidden" name="itinerario" value="'+itinerario[0]+'">'+
                    itinerario[3]+
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
                    var serv=value.split('//');
                    var val_p_g=serv[1];
                    // if(serv[2]==1)
                    //     val_p_g=Math.ceil(serv[1]/nroPasajeros);
                    iti_temp+='<tr><td><input type="hidden" name="iti_servicios_'+itinerario[0]+'" value="'+value+'">'+serv[0]+'</td>'+
                                '<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>'+
                                '<td>'+val_p_g+'</td>'+
                                '<td><a href="#!" class="text-16 text-danger" onclick="eliminar_iti_servicio()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>'+
                            '</tr>';
                });
                // console.log('servicios:');

            iti_temp+=''+
                '<tr>'+
                '<td class="" colspan="4">'+
                '<a class="hide" href="#add-services'+itinerario[0]+'" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>'+
                '<div class="col-md-12">'+
                '<label for="txta_description">Sugerencias para los servicios</label>'+
                '<textarea class="form-control" id="txt_sugerencia_'+itinerario[0]+'" name="txt_sugerencia[]" rows="3"></textarea>'+
                '</div>'+
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
    $('#totalItinerario_front').html(Itis_precio);
    $('#nroItinerario').val(total_Itinerarios);
    calcular_resumen();
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
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el destino "+destino+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
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

    })
}
function escojerPos(pos,cate) {
    $("#posTipo").val(pos);
    mostrar_pivot(cate);

}
function mostrar_pivot(cate){
    $("#t_TOURS").addClass('hide');
    $("#t_MOVILID").addClass('hide');
    $("#t_REPRESENT").addClass('hide');
    $("#t_ENTRANCES").addClass('hide');
    $("#t_FOOD").addClass('hide');
    $("#t_TRAINS").addClass('hide');
    $("#t_FLIGHTS").addClass('hide');
    $("#t_OTHERS").addClass('hide');
    $("#t_"+cate).removeClass('hide');
}

function eliminar_servicio(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el servicio "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/services/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_services_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}
function escojerPosEdit(pos,id) {
    $("#posTipoEdit_"+id).val(pos);
    // $("#posTipoEdit_id_"+id).val(id);
}
function eliminar_producto(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el producto "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/costs/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_services_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}

function escojerPosEdit_cost(id,pos){
    $("#posTipoEditcost_"+id).val(pos);
}
var desicion=0;
function mostrar_new_cost() {
    console.log('mostrando datos');
    if(desicion==0){
        desicion=1;
        $("#modal_new_cost").removeClass('hide');
        $("#modal_new_cost").fadeIn( "slow");
    }
    else if(desicion==1){
        desicion=0;
        $("#modal_new_cost").addClass('hide');
        $("#modal_new_cost").fadeOut( "slow");
    }
}
function pasar_pos_provider(pos) {
    $("#grupo_provider").val(pos);
}

function envia(){

        console.log('holaaaaaaaaaaaa');
        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        });
        var txt_grupo=$('#txt_grupo').val();
        var txt_localizacion=$('#txt_localizacion').val();
        var txt_ruc=$('#txt_ruc').val();
        var txt_razon_social=$('#txt_razon_social').val();
        var txt_direccion=$('#txt_direccion').val();
        var txt_telefono=$('#txt_telefono').val();
        var txt_celular=$('#txt_celular').val();
        var txt_email=$('#txt_email').val();
        var txt_r_nombres=$('#txt_r_nombres').val();
        var txt_r_telefono=$('#txt_r_telefono').val();
        var txt_c_nombres=$('#txt_c_nombres').val();
        var txt_c_telefono=$('#txt_c_telefono').val();

        $.ajax({
            url: '/admin/provider',//$(this).attr("action"),//action del formulario, ej:
            //http://localhost/mi_proyecto/mi_controlador/mi_funcion
            type: 'post',//$(this).attr("method"),//el método post o get del formulario
            data: $('#service_save_id').serialize()+'&txt_grupo='+txt_grupo+'&txt_localizacion='+txt_localizacion+'&txt_ruc='+txt_ruc+'&txt_razon_social='+txt_razon_social+
            '&txt_direccion='+txt_direccion+'&txt_telefono='+txt_telefono+'&txt_celular='+txt_celular+'&txt_email='+txt_email+'&txt_r_nombres='+txt_r_nombres+
            '&txt_r_telefono='+txt_r_telefono+'&txt_c_nombres='+txt_c_nombres+'&txt_c_telefono='+txt_c_telefono,//obtenemos todos los datos del formulario
            success: function (data) {
                //hacemos algo cuando finalice
                var rpt = data.split('_');
                console.log(data);
                if (rpt[0] == 1) {
                    // $("#response").html(data[1]);
                    var $pos = $("#grupo_provider").val();

                    $("#txt_provider_" + $pos).val(rpt[1] + ' ' + rpt[2]);
                    $("#rpt").html('' +
                        '<div class="alert alert-success">' +
                        '<strong>Success!</strong> Datos guardados,puede seguir con el proceso por favor cierre el popup' +
                        '</div>');
                }
                else {
                    $("#rpt").html('' +
                        '<div class="alert alert-error">' +
                        '<strong>Error!</strong> error al guardar al proveedor' +
                        '</div>');
                    // $("#response").html(data);
                }

            },
            error: function () {
                //si hay un error mostramos un mensaje
                $("#rpt").html('' +
                    '<div class="alert alert-danger">' +
                    '<strong>Danger!</strong> Error al guardar los datos del proveedor,vuelva a intentarlo' +
                    '</div>');
            }
        });
}
function eliminar_provider(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar al proveedor "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/provider/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_provider_"+id).fadeOut( "slow");
            }
            else if(data==2){
                swal(
                    'Porque no puedo borar?',
                    'El proveedor tiene costos asociados, vaya al modulo "Costs" y borre todos los registros asociados al proveedor.',
                    'warning'
                )
            }
        }).fail(function (data) {

        });

    })
}
function eliminar_itinerario(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el itinerario "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/itinerary/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_itinerary_"+id).fadeOut( "slow");

            }
            else if(data==2){
                // swal(
                //     'Porque no puedo borar?',
                //     'El proveedor tiene costos asociados, vaya al modulo "Costs" y borre todos los registros asociados al proveedor.',
                //     'warning'
                // )
            }
        }).fail(function (data) {
        });
    })
}

function sumar_servicios(grupo){
    var total_ci=0;
    $("input[class='servicios']").each(function (index) {
        if($(this).is(':checked')){
            var dato=$(this).val();
            var dato1=dato.split('_');
            // console.log(dato1[1]);
            if(dato1[0]==grupo) {
                total_ci += parseFloat(dato1[1]);
            }
            // console.log($(this).val());
        }
    });
     // console.log('total:'+total_ci);
    $('#total_ci_'+grupo).html(total_ci);
    $('#precio_itinerario_'+grupo).val(total_ci);

}

function  filtrar_grupos(){

    $("input[class='servicios']").each(function (index1) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        var esta=0;
        $("input[class='grupo']").each(function (index) {
            if($(this).is(':checked')) {
                var dato = $(this).val();
                var destino1 = dato.split('_');
                if(destino1[1] == servicio3[3]) {
                    esta=1;
                }
            }
        });
        if(esta==1) {
            $('#service_'+servicio3[2]).removeClass("hide");
            $('#service_'+servicio3[2]).fadeIn("slow");

        }
        else {
            $(this).prop("checked", "");
            $('#service_'+servicio3[2]).fadeOut("slow");
        }
    });

    $("input[class='servicios']").each(function (index2) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        sumar_servicios(servicio3[0]);
    });
}

function sumar_servicios_edit(grupo){
    var total_ci=0;
    $("input[class='servicios_edit']").each(function (index) {
        if($(this).is(':checked')){
            var dato=$(this).val();
            var dato1=dato.split('_');
            // console.log(dato1[1]);
            if(dato1[0]==grupo) {
                total_ci += parseFloat(dato1[1]);
            }
            // console.log($(this).val());
        }
    });
    // console.log('total:'+total_ci);
    $('#total_ci_'+grupo).html(total_ci);
    $('#precio_itinerario_'+grupo).val(total_ci);

}
function  filtrar_grupos_edit(itinerario){

    $("input[class='servicios_edit']").each(function (index1) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        if(servicio3[0]==itinerario){
            var esta=0;
            $("input[class='grupo_edit']").each(function (index) {
                if($(this).is(':checked')) {
                    var dato = $(this).val();
                    var destino1 = dato.split('_');
                    if(destino1[2] == itinerario) {
                        if(destino1[1] == servicio3[3]) {
                            esta=1;
                            // console.log('si esta:'+destino1[1]+'=='+servicio3[3]);
                        }
                    }
                }
            });
            if(esta==1) {
                $('#service_edit_'+itinerario+'_'+servicio3[2]).removeClass("hide");
                $('#service_edit_'+itinerario+'_'+servicio3[2]).fadeIn("slow");
                // console.log('no borrando:'+'#service_edit_'+itinerario+'_'+servicio3[2]);
            }
            else {
                $(this).prop("checked", "");
                $('#service_edit_'+itinerario+'_'+servicio3[2]).fadeOut("slow");
                // console.log('borrando:'+'#service_edit_'+itinerario+'_'+servicio3[2]);
            }
        }
    });

    $("input[class='servicios_edit']").each(function (index2) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        sumar_servicios_edit(servicio3[0]);
    });
}
function  filtrar_itinerarios(){

    $("input[class='itinerario']").each(function (index1) {
        var destino1 = $(this).val();
        var destino = destino1.split('_');
        var destinos=destino[1].split('*');
        // if(destino[0]==itinerario){
            var esta=0;
            console.log('entrando a los destinos');
            $("input[class='destinospack']").each(function (index) {
                if($(this).is(':checked')) {
                    var destino = $(this).val();
                    console.log('preguntando si esta:'+destino);
                    console.log('respuesta:'+$.inArray(destino,destinos));
                    if($.inArray(destino,destinos)>=0) {
                        esta=1;
                        console.log('si esta:'+destino);
                    }
                }
            });
            if(esta==1) {
                $('#itinerario'+destino[0]).removeClass("hide");
                $('#itinerario'+destino[0]).fadeIn("slow");
                console.log('no borrando:'+'#itinerario'+destino[0]);
            }
            else {
                $(this).prop("checked", "");
                $('#itinerario'+destino[0]).fadeOut("slow");
                console.log('borrando:'+'#itinerario'+destino[0]);
            }
        // }
    });

    // $("input[class='servicios_edit']").each(function (index2) {
    //     var dato3 = $(this).val();
    //     var servicio3 = dato3.split('_');
    //     sumar_servicios_edit(servicio3[0]);
    // });
}

function eliminar_iti(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el itinerario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#itis_'+id).fadeOut();
        $('#itis_'+id).remove();
        Itis_precio=Itis_precio-valor;
        $('#totalItinerario').val(Itis_precio);
        $('#totalItinerario_front').html(Itis_precio);
        calcular_resumen();
    })
}

function calcular_utilidad(){
    var $totalItinerario=$('#totalItinerario').val();
    var $txt_day=Math.ceil($('#txt_day').val()-1);
    var $txt_utilidad=$('#txt_utilidad').val();
    var $preciox_n_dias=$totalItinerario*($txt_day-1);
    // console.log('preciox_n_dias='+$preciox_n_dias);
    var $utilidad1=parseFloat($txt_utilidad)*parseFloat(0.01);
    // console.log('utilidad '+$txt_utilidad+' %='+$utilidad1);

    var $preciox_n_dias_venta=$preciox_n_dias+Math.round($preciox_n_dias*$utilidad1);
    $('#totalItinerario_venta').val($preciox_n_dias_venta);
    // console.log('precio venta='+$preciox_n_dias_venta);
}
function eliminar_categoria1(id,categoria) {
    // alert('holaaa:'+id+'_'+categoria);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la categoria "+categoria+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/categories/delete', 'id='+id, function(data) {
            if(data==1){
                $("#lista_categoria_"+id).remove();
                $("#lista_categoria_"+id).fadeOut( "slow");
                swal(
                    'Mensaje del sistema',
                    'Se borro la categoria '+categoria,
                    'success'
                )
            }
            if(data==0){
                swal(
                    'Porque no puedo borrar?',
                    'Algo salio mal, vuelva a intentarlo mas tarde',
                    'warning'
                )
            }
        }).fail(function (data) {
        });
    })
}
function calcular_resumen() {
    var utilidad_2 = parseFloat(parseFloat($("#profitt_2").val())*0.01);
    var utilidad_3 = parseFloat(parseFloat($("#profitt_3").val())*0.01);
    var utilidad_4 = parseFloat(parseFloat($("#profitt_4").val())*0.01);
    var utilidad_5 = parseFloat(parseFloat($("#profitt_5").val())*0.01);

    var cost_por_2=parseFloat(1-utilidad_2.toFixed(2))*100;
    var cost_por_3=parseFloat(1-utilidad_3.toFixed(2))*100;
    var cost_por_4=parseFloat(1-utilidad_4.toFixed(2))*100;
    var cost_por_5=parseFloat(1-utilidad_5.toFixed(2))*100;

    $("#porc_cost_2").html(cost_por_2.toFixed(2));
    $("#porc_cost_3").html(cost_por_3.toFixed(2));
    $("#porc_cost_4").html(cost_por_4.toFixed(2));
    $("#porc_cost_5").html(cost_por_5.toFixed(2));


    console.log(utilidad_3);
    var costo_itinerario = $("#totalItinerario").val();
    var txt_day = Math.ceil($('#txt_day').val() - 1);

    var amount_s2 = $("#amount_s2").val();
    var amount_d2 = Math.ceil(Math.ceil($("#amount_d2").val()) / 2);
    var amount_m2 = Math.ceil(Math.ceil($("#amount_m2").val()) / 2);
    var amount_t2 = Math.ceil(Math.ceil($("#amount_t2").val()) / 3);

    var amount_s3 = $("#amount_s3").val();
    var amount_d3 = Math.ceil(Math.ceil($("#amount_d3").val()) / 2);
    var amount_m3 = Math.ceil(Math.ceil($("#amount_m3").val()) / 2);
    var amount_t3 = Math.ceil(Math.ceil($("#amount_t3").val()) / 3);

    var amount_s4 = $("#amount_s4").val();
    var amount_d4 = Math.ceil(Math.ceil($("#amount_d4").val()) / 2);
    var amount_m4 = Math.ceil(Math.ceil($("#amount_m4").val()) / 2);
    var amount_t4 = Math.ceil(Math.ceil($("#amount_t4").val()) / 3);

    var amount_s5 = $("#amount_s5").val();
    var amount_d5 = Math.ceil(Math.ceil($("#amount_d5").val()) / 2);
    var amount_m5 = Math.ceil(Math.ceil($("#amount_m5").val()) / 2);
    var amount_t5 = Math.ceil(Math.ceil($("#amount_t5").val()) / 3);


    var amount_s2_u = Math.ceil(costo_itinerario) + Math.ceil(amount_s2);
    var amount_d2_u = Math.ceil(costo_itinerario) + Math.ceil(amount_d2);
    var amount_m2_u = Math.ceil(costo_itinerario) + Math.ceil(amount_m2);
    var amount_t2_u = Math.ceil(costo_itinerario) + Math.ceil(amount_t2);
    var amount_s3_u = Math.ceil(costo_itinerario) + Math.ceil(amount_s3);
    var amount_d3_u = Math.ceil(costo_itinerario) + Math.ceil(amount_d3);
    var amount_m3_u = Math.ceil(costo_itinerario) + Math.ceil(amount_m3);
    var amount_t3_u = Math.ceil(costo_itinerario) + Math.ceil(amount_t3);
    var amount_s4_u = Math.ceil(costo_itinerario) + Math.ceil(amount_s4);
    var amount_d4_u = Math.ceil(costo_itinerario) + Math.ceil(amount_d4);
    var amount_m4_u = Math.ceil(costo_itinerario) + Math.ceil(amount_m4);
    var amount_t4_u = Math.ceil(costo_itinerario) + Math.ceil(amount_t4);
    var amount_s5_u = Math.ceil(costo_itinerario) + Math.ceil(amount_s5);
    var amount_d5_u = Math.ceil(costo_itinerario) + Math.ceil(amount_d5);
    var amount_m5_u = Math.ceil(costo_itinerario) + Math.ceil(amount_m5);
    var amount_t5_u = Math.ceil(costo_itinerario) + Math.ceil(amount_t5);


    // console.log('_costo_itinerario:'+costo_itinerario+'_amount_s2:'+amount_s2+'_txt_day:'+txt_day+'_nroPasajeros:'+nroPasajeros);
    // var amount_s2_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_s2)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    var amount_s2_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_s2) * Math.ceil(txt_day)));
    var amount_s2_u_pro = Math.ceil(amount_s2_u * utilidad_2);
    var amount_s2_u_pri = Math.ceil(amount_s2_u + amount_s2_u_pro);

    var amount_d2_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_d2) * Math.ceil(txt_day)));
    var amount_d2_u_pro = Math.ceil(amount_d2_u * utilidad_2);
    var amount_d2_u_pri = Math.ceil(amount_d2_u + amount_d2_u_pro);

    var amount_m2_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_m2) * Math.ceil(txt_day)));
    var amount_m2_u_pro = Math.ceil(amount_m2_u * utilidad_2);
    var amount_m2_u_pri = Math.ceil(amount_m2_u + amount_m2_u_pro);

    var amount_t2_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_t2) * Math.ceil(txt_day)));
    var amount_t2_u_pro = Math.ceil(amount_t2_u * utilidad_2);
    var amount_t2_u_pri = Math.ceil(amount_t2_u + amount_t2_u_pro);

    var amount_s3_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_s3) * Math.ceil(txt_day)));
    var amount_s3_u_pro = Math.ceil(amount_s3_u * utilidad_3);
    var amount_s3_u_pri = Math.ceil(amount_s3_u + amount_s3_u_pro);

    var amount_d3_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_d3) * Math.ceil(txt_day)));
    var amount_d3_u_pro = Math.ceil(amount_d3_u * utilidad_3);
    var amount_d3_u_pri = Math.ceil(amount_d3_u + amount_d3_u_pro);

    var amount_m3_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_m3) * Math.ceil(txt_day)));
    var amount_m3_u_pro = Math.ceil(amount_m3_u * utilidad_3);
    var amount_m3_u_pri = Math.ceil(amount_m3_u + amount_m3_u_pro);

    var amount_t3_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_t3) * Math.ceil(txt_day)));
    var amount_t3_u_pro = Math.ceil(amount_t3_u * utilidad_3);
    var amount_t3_u_pri = Math.ceil(amount_t3_u + amount_t3_u_pro);

    var amount_s4_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_s4) * Math.ceil(txt_day)));
    var amount_s4_u_pro = Math.ceil(amount_s4_u * utilidad_4);
    var amount_s4_u_pri = Math.ceil(amount_s4_u + amount_s4_u_pro);

    var amount_d4_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_d4) * Math.ceil(txt_day)));
    var amount_d4_u_pro = Math.ceil(amount_d4_u * utilidad_4);
    var amount_d4_u_pri = Math.ceil(amount_d4_u + amount_d4_u_pro);

    var amount_m4_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_m4) * Math.ceil(txt_day)));
    var amount_m4_u_pro = Math.ceil(amount_m4_u * utilidad_4);
    var amount_m4_u_pri = Math.ceil(amount_m4_u + amount_m4_u_pro);

    var amount_t4_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_t4) * Math.ceil(txt_day)));
    var amount_t4_u_pro = Math.ceil(amount_t4_u * utilidad_4);
    var amount_t4_u_pri = Math.ceil(amount_t4_u + amount_t4_u_pro);

    var amount_s5_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_s5) * Math.ceil(txt_day)));
    var amount_s5_u_pro = Math.ceil(amount_s5_u * utilidad_5);
    var amount_s5_u_pri = Math.ceil(amount_s5_u + amount_s5_u_pro);

    var amount_d5_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_d5) * Math.ceil(txt_day)));
    var amount_d5_u_pro = Math.ceil(amount_d5_u * utilidad_5);
    var amount_d5_u_pri = Math.ceil(amount_d5_u + amount_d5_u_pro);

    var amount_m5_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_m5) * Math.ceil(txt_day)));
    var amount_m5_u_pro = Math.ceil(amount_m5_u * utilidad_5);
    var amount_m5_u_pri = Math.ceil(amount_m5_u + amount_m5_u_pro);

    var amount_t5_u = (Math.ceil(costo_itinerario) + (Math.ceil(amount_t5) * Math.ceil(txt_day)));
    var amount_t5_u_pro = Math.ceil(amount_t5_u * utilidad_5);
    var amount_t5_u_pri = Math.ceil(amount_t5_u + amount_t5_u_pro);
    // console.log('con utilidad'+amount_s2_u);
    //
    // var amount_d2_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_d2)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_d2_u=Math.ceil(amount_d2_u*utilidad);
    // var amount_t2_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_t2)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_t2_u=Math.ceil(amount_t2_u*utilidad);
    //
    // var amount_s3_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_s3)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_s3_u=Math.ceil(amount_s3_u*utilidad);
    // var amount_d3_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_d3)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_d3_u=Math.ceil(amount_d3_u*utilidad);
    // var amount_t3_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_t3)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_t3_u=Math.ceil(amount_t3_u*utilidad);
    //
    // var amount_s4_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_s4)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_s4_u=Math.ceil(amount_s4_u*utilidad);
    // var amount_d4_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_d4)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_d4_u=Math.ceil(amount_d4_u*utilidad);
    // var amount_t4_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_t4)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_t4_u=Math.ceil(amount_t4_u*utilidad);
    //
    // var amount_s5_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_s5)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_s5_u=Math.ceil(amount_s5_u*utilidad);
    // var amount_d5_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_d5)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_d5_u=Math.ceil(amount_d5_u*utilidad);
    // var amount_t5_u=(Math.ceil(costo_itinerario)+(Math.ceil(amount_t5)*Math.ceil(txt_day)))*Math.ceil(nroPasajeros);
    // amount_t5_u=Math.ceil(amount_t5_u*utilidad);
    console.log('amount_s2_u:' + amount_s2_u);
    $("#amount_s2_a").html(amount_s2_u);
    $("#amount_s2_a_p").html(amount_s2_u_pro);
    $("#amount_s2_a_v").html(amount_s2_u_pri);

    $("#amount_d2_a").html(amount_d2_u);
    $("#amount_d2_a_p").html(amount_d2_u_pro);
    $("#amount_d2_a_v").html(amount_d2_u_pri);

    $("#amount_m2_a").html(amount_m2_u);
    $("#amount_m2_a_p").html(amount_m2_u_pro);
    $("#amount_m2_a_v").html(amount_m2_u_pri);

    $("#amount_t2_a").html(amount_t2_u);
    $("#amount_t2_a_p").html(amount_t2_u_pro);
    $("#amount_t2_a_v").html(amount_t2_u_pri);

    console.log('amount_s3_u:' + amount_s3_u);
    $("#amount_s3_a").html(amount_s3_u);
    $("#amount_s3_a_p").html(amount_s3_u_pro);
    $("#amount_s3_a_v").html(amount_s3_u_pri);

    $("#amount_d3_a").html(amount_d3_u);
    $("#amount_d3_a_p").html(amount_d3_u_pro);
    $("#amount_d3_a_v").html(amount_d3_u_pri);

    $("#amount_m3_a").html(amount_m3_u);
    $("#amount_m3_a_p").html(amount_m3_u_pro);
    $("#amount_m3_a_v").html(amount_m3_u_pri);

    $("#amount_t3_a").html(amount_t3_u);
    $("#amount_t3_a_p").html(amount_t3_u_pro);
    $("#amount_t3_a_v").html(amount_t3_u_pri);

    console.log('amount_s4_u:'+amount_s4_u);
    $("#amount_s4_a").html(amount_s4_u);
    $("#amount_s4_a_p").html(amount_s4_u_pro);
    $("#amount_s4_a_v").html(amount_s4_u_pri);

    $("#amount_d4_a").html(amount_d4_u);
    $("#amount_d4_a_p").html(amount_d4_u_pro);
    $("#amount_d4_a_v").html(amount_d4_u_pri);

    $("#amount_m4_a").html(amount_m4_u);
    $("#amount_m4_a_p").html(amount_m4_u_pro);
    $("#amount_m4_a_v").html(amount_m4_u_pri);

    $("#amount_t4_a").html(amount_t4_u);
    $("#amount_t4_a_p").html(amount_t4_u_pro);
    $("#amount_t4_a_v").html(amount_t4_u_pri);

    console.log('amount_s5_u:'+amount_s5_u);
    $("#amount_s5_a").html(amount_s5_u);
    $("#amount_s5_a_p").html(amount_s5_u_pro);
    $("#amount_s5_a_v").html(amount_s5_u_pri);

    $("#amount_d5_a").html(amount_d5_u);
    $("#amount_d5_a_p").html(amount_d5_u_pro);
    $("#amount_d5_a_v").html(amount_d5_u_pri);

    $("#amount_m5_a").html(amount_m5_u);
    $("#amount_m5_a_p").html(amount_m5_u_pro);
    $("#amount_m5_a_v").html(amount_m5_u_pri);

    $("#amount_t5_a").html(amount_t5_u);
    $("#amount_t5_a_p").html(amount_t5_u_pro);
    $("#amount_t5_a_v").html(amount_t5_u_pri);


    // console.log('amount_s3_u:'+amount_s3_u);
    // $("#amount_s3_u").val(amount_s3_u);
    // $("#amount_s3_a").html(amount_s3_u);
    //
    // $("#amount_d3_u").val(amount_d3_u);
    // $("#amount_d3_a").html(amount_d3_u);
    //
    // $("#amount_m3_u").val(amount_d3_u);
    // $("#amount_m3_a").html(amount_d3_u);
    //
    // $("#amount_t3_u").val(amount_t3_u);
    // $("#amount_t3_a").html(amount_t3_u);
    //
    //
    // $("#amount_s4_u").val(amount_s4_u);
    // $("#amount_d4_u").val(amount_d4_u);
    // $("#amount_t4_u").val(amount_t4_u);
    //
    // $("#amount_s5_u").val(amount_s5_u);
    // $("#amount_d5_u").val(amount_d5_u);
    // $("#amount_t5_u").val(amount_t5_u);
}
function filtrar_estrellas(){
    if( $('#strellas_2').prop('checked') ) {
        $('#precio_2').removeClass('hide');
        $('#precio_2').fadeIn();
        $('#precio_2_t').removeClass('hide');
        $('#precio_2_t').fadeIn();
        $('#precio_t_2').removeClass('hide');
        $('#precio_t_2').fadeIn();
        $('#precio_d_2').removeClass('hide');
        $('#precio_d_2').fadeIn();
        $('#precio_s_2').removeClass('hide');
        $('#precio_s_2').fadeIn();
    }
    else{
        $('#precio_2').addClass('hide');
        $('#precio_2').fadeOut();
        $('#precio_2_t').addClass('hide');
        $('#precio_2_t').fadeOut();
        $('#precio_t_2').addClass('hide');
        $('#precio_t_2').fadeOut();
        $('#precio_d_2').addClass('hide');
        $('#precio_d_2').fadeOut();
        $('#precio_s_2').addClass('hide');
        $('#precio_s_2').fadeOut();
    }

    if( $('#strellas_3').prop('checked') ) {
        $('#precio_3').removeClass('hide');
        $('#precio_3').fadeIn();
        $('#precio_3_t').removeClass('hide');
        $('#precio_3_t').fadeIn();
        $('#precio_t_3').removeClass('hide');
        $('#precio_t_3').fadeIn();
        $('#precio_d_3').removeClass('hide');
        $('#precio_d_3').fadeIn();
        $('#precio_s_3').removeClass('hide');
        $('#precio_s_3').fadeIn();
    }
    else{
        $('#precio_3').addClass('hide');
        $('#precio_3').fadeOut();
        $('#precio_3_t').addClass('hide');
        $('#precio_3_t').fadeOut();
        $('#precio_t_3').addClass('hide');
        $('#precio_t_3').fadeOut();
        $('#precio_d_3').addClass('hide');
        $('#precio_d_3').fadeOut();
        $('#precio_s_3').addClass('hide');
        $('#precio_s_3').fadeOut();
    }

    if( $('#strellas_4').prop('checked') ) {
        $('#precio_4').removeClass('hide');
        $('#precio_4').fadeIn();
        $('#precio_4_t').removeClass('hide');
        $('#precio_4_t').fadeIn();
        $('#precio_t_4').removeClass('hide');
        $('#precio_t_4').fadeIn();
        $('#precio_d_4').removeClass('hide');
        $('#precio_d_4').fadeIn();
        $('#precio_s_4').removeClass('hide');
        $('#precio_s_4').fadeIn();
    }
    else{
        $('#precio_4').addClass('hide');
        $('#precio_4').fadeOut();
        $('#precio_4_t').addClass('hide');
        $('#precio_4_t').fadeOut();
        $('#precio_t_4').addClass('hide');
        $('#precio_t_4').fadeOut();
        $('#precio_d_4').addClass('hide');
        $('#precio_d_4').fadeOut();
        $('#precio_s_4').addClass('hide');
        $('#precio_s_4').fadeOut();
    }

    if( $('#strellas_5').prop('checked') ) {
        $('#precio_5').removeClass('hide');
        $('#precio_5').fadeIn();
        $('#precio_5_t').removeClass('hide');
        $('#precio_5_t').fadeIn();
        $('#precio_t_5').removeClass('hide');
        $('#precio_t_5').fadeIn();
        $('#precio_d_5').removeClass('hide');
        $('#precio_d_5').fadeIn();
        $('#precio_s_5').removeClass('hide');
        $('#precio_s_5').fadeIn();
    }
    else{
        $('#precio_5').addClass('hide');
        $('#precio_5').fadeOut();
        $('#precio_5_t').addClass('hide');
        $('#precio_5_t').fadeOut();
        $('#precio_t_5').addClass('hide');
        $('#precio_t_5').fadeOut();
        $('#precio_d_5').addClass('hide');
        $('#precio_d_5').fadeOut();
        $('#precio_s_5').addClass('hide');
        $('#precio_s_5').fadeOut();
    }
}
function ordenar_itinerarios(){
    var nr=1;
    $( ".lista_dias" ).each(function( index ) {
        $( this ).html('Dia '+nr+':');
        nr++;
    });
}
function filtrar_mo_lista(cat){
    // var filtrotito=$('#filtro_localizacion_'+cat).val();
    //
    // $("#tb_"+cat+" tbody tr").each(function (index)
    // {
    //     $(this).children("td").each(function (index2)
    //     {
    //         // if(index2==1){
    //         //     var loca=$(this).text();
    //         //     if(loca!=filtrotito){
    //         //         $('#')
    //         //     }
    //         // }
    //         switch (index2)
    //         {
    //             case 0: console.log($(this).text());
    //                 break;
    //             case 1: console.log($(this).text());
    //                 break;
    //             case 2: console.log($(this).text());
    //                 break;
    //         }
    //         // $(this).css("background-color", "#ECF8E0");
    //     })
    // })
}
function activarPlan(paquete_precio_id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "Esta seguro de elejir este plan",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/activar-package', 'paquete_precio_id='+paquete_precio_id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                // $("#lista_itinerary_"+id).fadeOut( "slow");
                // alert('se activo');
                // $("input[class='planes']").each(function (index) {
                //     $(this).prop('onclick',null).off('click');
                //
                // });
                var $nro_planes=parseInt($('#nro_planes').val());
                for(var $d=0;$d<$nro_planes;$d++){
                    $('#plan_'+$d).prop('onclick',null);
                    $('#plan_'+$d).unbind( "click" );
                    // alert('plan_'+$d);
                }

                $('#plan_'+plan).removeClass('btn-danger');
                $('#plan_'+plan).addClass('btn-success');

            }
            else if(data==2){
                // swal(
                //     'Porque no puedo borar?',
                //     'El proveedor tiene costos asociados, vaya al modulo "Costs" y borre todos los registros asociados al proveedor.',
                //     'warning'
                // )
            }
        }).fail(function (data) {
        });

    }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {

        }
    })
}
function mostrar_categoria(plan_id){
    var $categoria=$('#categoria').val();
    var $travelers=$('#travelers').val();
    console.log($categoria+'_'+$travelers);
    $('#star_2').addClass('hide');
    $('#star_3').addClass('hide');
    $('#star_4').addClass('hide');
    $('#star_5').addClass('hide');
    $('#star_'+$categoria).removeClass('hide');
    $('#pos').val($categoria);
    var s=0;
    var d=0;
    var m=0;
    var t=0;
    var nro=$travelers;
    var acomo_=$('#plan_'+plan_id+'_'+$categoria).val().split('_');
    console.log('acom:'+acomo_);
    if(existe_ar(3, acomo_ )) {
        t = parseInt(nro / 3);
        nro = nro - (3 * t);
        console.log('si hat 3');
    }
    if(existe_ar(2, acomo_ )) {
        d=parseInt(nro/2);
        nro=nro-(2*d);
        console.log('si hat 2');
    }
    if(existe_ar(1, acomo_ )) {
        s=nro;
        console.log('si hat 1');
    }
    console.log('s_:'+s);
    console.log('d_:'+d);
    console.log('m_:'+m);
    console.log('t_:'+t);

    $('#s_'+$categoria).val(s);
    $('#d_'+$categoria).val(d);
    $('#m_'+$categoria).val(m);
    $('#t_'+$categoria).val(t);
    cambios_acom_precios($categoria,plan_id);
}
function cambios_acom_precios($categoria,plan_id){
    var acomo_=$('#plan_'+plan_id+'_'+$categoria).val().split('_');
    var p_s=0;
    var p_d=0;
    var p_m=0;
    var p_t=0;

    var v_s=0;
    var v_d=0;
    var v_m=0;
    var v_t=0;


    if(existe_ar(1, acomo_ )) {
        p_s=$('#hp_s_'+$categoria).html();
        v_s=$('#s_'+$categoria).val();
    }
    if(existe_ar(2, acomo_ )) {
        p_d=$('#hp_d_'+$categoria).html();
        v_d=$('#d_'+$categoria).val();
    }
    if(existe_ar(4, acomo_ )) {
        p_m=$('#hp_m_'+$categoria).html();
        v_m=$('#m_'+$categoria).val();
    }
    if(existe_ar(3, acomo_ )) {
        p_t=$('#hp_t_'+$categoria).html();
        v_t=$('#t_'+$categoria).val();
    }

    console.log('s:'+v_s*p_s);
    console.log('d:'+v_d*p_d);
    console.log('m:'+v_m*p_m);
    console.log('t:'+v_t*p_t);

    $('#p_s_'+$categoria).html(v_s*p_s+'.00');
    $('#p_d_'+$categoria).html(v_d*p_d*2+'.00');
    $('#p_m_'+$categoria).html(v_m*p_m*2+'.00');
    $('#p_t_'+$categoria).html(v_t*p_t*3+'.00');
    $('#detalle_p_s_'+$categoria).html(v_s+' x $'+p_s+' x <i class="fa fa-male" aria-hidden="true"></i> =');
    $('#detalle_p_d_'+$categoria).html(v_d+' x $'+p_d+' x <i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i> =');
    $('#detalle_p_m_'+$categoria).html(v_m+' x $'+p_m+' x <i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i> =');
    $('#detalle_p_t_'+$categoria).html(v_t+' x $'+p_t+' x <i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i><i class="fa fa-male" aria-hidden="true"></i> =');
    $('#total_'+$categoria).html(((v_s*p_s)+(v_d*p_d*2)+(v_m*p_m*2)+(v_t*p_t*3))+'.00');

}
function eliminar_paquete(id,destino) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el paquete "+destino+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/package/delete', 'id='+id, function(data) {
            if(data==1){
                $("#lista_destinos_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {
        });

    })
}
function mostra_ventas(mes,cat){
    // if(cat=='c') {
        // var =$("#t_ene_c").html()
        $("#t_ene_c").addClass('hide');
        $("#t_feb_c").addClass('hide');
        $("#t_mar_c").addClass('hide');
        $("#t_abr_c").addClass('hide');
        $("#t_may_c").addClass('hide');
        $("#t_jun_c").addClass('hide');
        $("#t_jul_c").addClass('hide');
        $("#t_ago_c").addClass('hide');
        $("#t_set_c").addClass('hide');
        $("#t_oct_c").addClass('hide');
        $("#t_nov_c").addClass('hide');
        $("#t_dic_c").addClass('hide');
        $("#t_"+mes+"_c").removeClass('hide');
        $("#n_mes_ene_c").removeClass('text-primary');
        $("#n_mes_ene_c").removeClass('text-uppercase');
        $("#n_mes_feb_c").removeClass('text-primary');
        $("#n_mes_feb_c").removeClass('text-uppercase');
        $("#n_mes_mar_c").removeClass('text-primary');
        $("#n_mes_mar_c").removeClass('text-uppercase');
        $("#n_mes_abr_c").removeClass('text-primary');
        $("#n_mes_abr_c").removeClass('text-uppercase');
        $("#n_mes_may_c").removeClass('text-primary');
        $("#n_mes_may_c").removeClass('text-uppercase');
        $("#n_mes_jun_c").removeClass('text-primary');
        $("#n_mes_jun_c").removeClass('text-uppercase');
        $("#n_mes_jul_c").removeClass('text-primary');
        $("#n_mes_jul_c").removeClass('text-uppercase');
        $("#n_mes_ago_c").removeClass('text-primary');
        $("#n_mes_ago_c").removeClass('text-uppercase');
        $("#n_mes_set_c").removeClass('text-primary');
        $("#n_mes_set_c").removeClass('text-uppercase');
        $("#n_mes_oct_c").removeClass('text-primary');
        $("#n_mes_oct_c").removeClass('text-uppercase');
        $("#n_mes_nov_c").removeClass('text-primary');
        $("#n_mes_nov_c").removeClass('text-uppercase');
        $("#n_mes_dic_c").removeClass('text-primary');
        $("#n_mes_dic_c").removeClass('text-uppercase');
        $("#n_mes_"+mes+"_c").addClass('text-primary');
        $("#n_mes_"+mes+"_c").addClass('text-uppercase');

        $("#t_ene_s").addClass('hide');
        $("#t_feb_s").addClass('hide');
        $("#t_mar_s").addClass('hide');
        $("#t_abr_s").addClass('hide');
        $("#t_may_s").addClass('hide');
        $("#t_jun_s").addClass('hide');
        $("#t_jul_s").addClass('hide');
        $("#t_ago_s").addClass('hide');
        $("#t_set_s").addClass('hide');
        $("#t_oct_s").addClass('hide');
        $("#t_nov_s").addClass('hide');
        $("#t_dic_s").addClass('hide');
        $("#t_"+mes+"_s").removeClass('hide');
        $("#n_mes_ene_s").removeClass('text-primary');
        $("#n_mes_ene_s").removeClass('text-uppercase');
        $("#n_mes_feb_s").removeClass('text-primary');
        $("#n_mes_feb_s").removeClass('text-uppercase');
        $("#n_mes_mar_s").removeClass('text-primary');
        $("#n_mes_mar_s").removeClass('text-uppercase');
        $("#n_mes_abr_s").removeClass('text-primary');
        $("#n_mes_abr_s").removeClass('text-uppercase');
        $("#n_mes_may_s").removeClass('text-primary');
        $("#n_mes_may_s").removeClass('text-uppercase');
        $("#n_mes_jun_s").removeClass('text-primary');
        $("#n_mes_jun_s").removeClass('text-uppercase');
        $("#n_mes_jul_s").removeClass('text-primary');
        $("#n_mes_jul_s").removeClass('text-uppercase');
        $("#n_mes_ago_s").removeClass('text-primary');
        $("#n_mes_ago_s").removeClass('text-uppercase');
        $("#n_mes_set_s").removeClass('text-primary');
        $("#n_mes_set_s").removeClass('text-uppercase');
        $("#n_mes_oct_s").removeClass('text-primary');
        $("#n_mes_oct_s").removeClass('text-uppercase');
        $("#n_mes_nov_s").removeClass('text-primary');
        $("#n_mes_nov_s").removeClass('text-uppercase');
        $("#n_mes_dic_s").removeClass('text-primary');
        $("#n_mes_dic_s").removeClass('text-uppercase');
        $("#n_mes_"+mes+"_s").addClass('text-primary');
        $("#n_mes_"+mes+"_s").addClass('text-uppercase');



    // }


}
function existe_ar(valor,arreglo) {
    var o=0;
    var lon=arreglo.length;
    var existe=false;
    while(o<lon && !existe){
        if(arreglo[o]==valor)
            existe=true;
        o++;
    }
    return existe;
}
function categorizar(id,cate) {
    var anio=$('#anio_s').html();
    var texto='';
    if(cate=='C')
        texto='¿Esta seguro de asignar factura para esta venta?';
    else
        texto='¿Esta seguro de no asignar factura para esta venta?';

    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: texto,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/venta/categorizar', 'id='+id+'&&cate='+cate, function(data) {
            // console.log(data);
            if(data==1){
                window.location.href = anio;
                // $("#lista_destinos_"+id).remove();
                // $("#lista_venta_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}
function confirmar_fecha(id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: '¿Esta seguro de confirmar el monto y fecha?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var precio=$('#precio_c_'+id).val();
        var fecha=$('#fecha_pago_'+id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/contabilidad/conciliar-venta', 'id='+id+'&&precio='+precio+'&&fecha='+fecha, function(data) {
            var data1=data.split('_');
            if(data1[0]=='1'){
                $('#servicio_'+id).html('Confirmada');
                $('#servicio_'+id).removeClass('btn-danger');
                $('#servicio_'+id).addClass('btn-success');
                $('#servicio_'+id).off("click");
                $('#servicio_pago_'+id).val(data1[1]);
                pasar_price(id);
            }
        }).fail(function (data) {
            console.log(data);
        });

    })
}
function insertar_codigo(id){
    var $codigo=$('#code_'+id).val();
    // console.log($codigo);
}
function calcular_saldo(id){
    var $total=parseFloat($('#total_'+id).html());
    var $serv_acta=parseFloat($('#serv_acta_'+id).val());
    var $saldo=parseFloat($total-$serv_acta);
    console.log('total:'+$total+'_acta:'+$serv_acta+'_saldo:'+$saldo);
    $('#saldo_'+id).val($saldo);
    $('#ifecha_pago_'+id).removeClass('hide');
    if($saldo==0)
        $('#ifecha_pago_'+id).addClass('hide');
    else
        $('#ifecha_pago_'+id).removeClass('hide');
}
function enviar_form(id){
    $('#fo_'+id).submit(function() {
        var prox_fecha=$('#prox_fecha_'+id).val();
        if(!prox_fecha){
            $('#prox_fecha_'+id).focusin();
        }
        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#for_'+id).addClass('hide');
                    $('#result_'+id).removeClass('text-danger');
                    $('#result_'+id).addClass('text-success');
                    $('#result_'+id).html('Pago guardado Correctamente!');
                }
                else{
                    $('#result_'+id).removeClass('text-success');
                    $('#result_'+id).addClass('text-danger');
                    $('#result_'+id).html('Error al pagar, intentelo de nuevo');
                }
            }
        })
        return false;
    });
}
function pasar_price(id){
    $("#serv_acta_"+id).attr({
        "max" : $('#precio_c_'+id).val(),        // substitute your own
    });
    $('#total_'+id).html($('#precio_c_'+id).val());
    $('#itotal_'+id).val($('#precio_c_'+id).val());

}
function mostrar_hoteles(pos) {
    var loca=$('#txt_localizacion_'+pos).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/ventas/hotel/traer-precios', 'loca='+loca, function(data) {
        var data1=data.split('_');
            $('#hotel_id_2').val(data1[0]);
            $('#S_2').val(data1[1]);
            $('#D_2').val(data1[2]);
            $('#M_2').val(data1[3]);
            $('#T_2').val(data1[4]);
            $('#SS_2').val(data1[5]);
            $('#SD_2').val(data1[6]);
            $('#SU_2').val(data1[7]);
            $('#JS_2').val(data1[8]);
            $('#hotel_id_3').val(data1[9]);
            $('#S_3').val(data1[10]);
            $('#D_3').val(data1[11]);
            $('#M_3').val(data1[12]);
            $('#T_3').val(data1[13]);
            $('#SS_3').val(data1[14]);
            $('#SD_3').val(data1[15]);
            $('#SU_3').val(data1[16]);
            $('#JS_3').val(data1[17]);
            $('#hotel_id_4').val(data1[18]);
            $('#S_4').val(data1[19]);
            $('#D_4').val(data1[20]);
            $('#M_4').val(data1[21]);
            $('#T_4').val(data1[22]);
            $('#SS_4').val(data1[23]);
            $('#SD_4').val(data1[24]);
            $('#SU_4').val(data1[25]);
            $('#JS_4').val(data1[26]);
            $('#hotel_id_5').val(data1[27]);
            $('#S_5').val(data1[28]);
            $('#D_5').val(data1[29]);
            $('#M_5').val(data1[30]);
            $('#T_5').val(data1[31]);
            $('#SS_5').val(data1[32]);
            $('#SD_5').val(data1[33]);
            $('#SU_5').val(data1[34]);
            $('#JS_5').val(data1[35]);


    }).fail(function (data) {
        console.log(data);
    });
}
function eliminar_servicio_h(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar los precios del hotel?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/hotel/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_services_h_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}
function Eliminar_cotizacion(id,titulo) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la cotizacion "+titulo+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/cotizacion/delete', 'id='+id, function(data) {
            if(data==1){
                $("#coti_new"+id).fadeOut( "slow");
            }
        }).fail(function (data) {
            console.log(data);
        });

    })
}
function confirmar_fecha_h(id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: '¿Esta seguro de confirmar el monto y fecha?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var precio=$('#precio_h_c_'+id).val();
        var fecha=$('#fecha_pago_h_'+id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/contabilidad/conciliar-venta-h', 'id='+id+'&&precio='+precio+'&&fecha='+fecha, function(data) {
            var data1=data.split('_');
            if(data1[0]=='1'){
                $('#servicio_h_'+id).html('Confirmada');
                $('#servicio_h_'+id).removeClass('btn-danger');
                $('#servicio_h_'+id).addClass('btn-success');
                $('#servicio_h_'+id).off("click");
                $('#servicio_pago_h_'+id).val(data1[1]);
                pasar_price_h(id);
            }
        }).fail(function (data) {
            console.log(data);
        });

    })
}
function pasar_price_h(id){
    $("#serv_acta_h_"+id).attr({
        "max" : $('#precio_c_h_'+id).val(),        // substitute your own
    });
    $('#total_h_'+id).html($('#precio_c_h_'+id).val());
    $('#itotal_h_'+id).val($('#precio_c_h_'+id).val());

}
function marcar_anio_desde(signo,fecha) {
    fecha=parseInt($('#anio_desde').html());
    if(signo=='+') {
        fecha++;
        $('#anio_desde').html(fecha);
        $('#anio_desde_').val(fecha);
    }
    else{
        fecha--;
        $('#anio_desde').html(fecha);
        $('#anio_desde_').val(fecha);
    }
}
function marcar_mes_desde(mes){
    $('#mes_desde_').val(mes);
    $('#mes_desde_01').addClass('btn-primary');
    $('#mes_desde_01').removeClass('btn-warning');
    $('#mes_desde_02').removeClass('btn-warning');
    $('#mes_desde_03').removeClass('btn-warning');
    $('#mes_desde_04').removeClass('btn-warning');
    $('#mes_desde_05').removeClass('btn-warning');
    $('#mes_desde_06').removeClass('btn-warning');
    $('#mes_desde_07').removeClass('btn-warning');
    $('#mes_desde_08').removeClass('btn-warning');
    $('#mes_desde_09').removeClass('btn-warning');
    $('#mes_desde_10').removeClass('btn-warning');
    $('#mes_desde_11').removeClass('btn-warning');
    $('#mes_desde_12').removeClass('btn-warning');
    $('#mes_desde_'+mes).addClass('btn-warning');
}
function marcar_mes_hasta(mes){
    $('#mes_hasta_').val(mes);
    $('#mes_hasta_01').addClass('btn-primary');
    $('#mes_hasta_01').removeClass('btn-warning');
    $('#mes_hasta_02').removeClass('btn-warning');
    $('#mes_hasta_03').removeClass('btn-warning');
    $('#mes_hasta_04').removeClass('btn-warning');
    $('#mes_hasta_05').removeClass('btn-warning');
    $('#mes_hasta_06').removeClass('btn-warning');
    $('#mes_hasta_07').removeClass('btn-warning');
    $('#mes_hasta_08').removeClass('btn-warning');
    $('#mes_hasta_09').removeClass('btn-warning');
    $('#mes_hasta_10').removeClass('btn-warning');
    $('#mes_hasta_11').removeClass('btn-warning');
    $('#mes_hasta_12').removeClass('btn-warning');
    $('#mes_hasta_'+mes).addClass('btn-warning');
}
function marcar_anio_hasta(signo,fecha) {
    fecha=parseInt($('#anio_hasta').html());
    if(signo=='+') {
        fecha++;
        $('#anio_hasta').html(fecha);
        $('#anio_hasta_').val(fecha);
    }
    else{
        fecha--;
        $('#anio_hasta').html(fecha);
        $('#anio_hasta_').val(fecha);
    }
}
var escojer_consulta1=0;
function escojer_consulta() {
    if(escojer_consulta1==0) {
        $('#lista').fadeOut();
        $('#lista').addClass('hide');

        $('#custon').fadeIn();
        $('#custon').removeClass('hide');
        escojer_consulta1=1;
        $('#custon1').html('Lista');
        $('#opcion').val('Custon');
    }
    else{
        $('#custon').fadeOut();
        $('#custon').addClass('hide');

        $('#lista').fadeIn();
        $('#lista').removeClass('hide');
        escojer_consulta1=0;
        $('#custon1').html('Custon');
        $('#opcion').val('Lista');
    }
}
var destinos='';
function  filtrar_itinerarios1(){
    var destino1 =$('#desti').val().split('/');

    $.each(destino1,function (index1,value){
        $('#group_destino_'+value).addClass("hide");
        $('#group_destino_'+value).fadeOut("slow");
    });
    var esta=0;
    destinos='';
    var valorci='';
    $("input[class='destinospack']").each(function (index) {
        if($(this).is(':checked')) {
            valorci=$(this).val().split('_');
            console.log('destino escojido:'+valorci[0]);
            destinos+=valorci[0]+'/';
            var destino = $(this).val();
            $('#group_destino_'+valorci[0]).removeClass("hide");
            $('#group_destino_'+valorci[0]).fadeIn("slow");

        }
    });
    destinos=destinos.substr(0,destinos.length-1);
    filtrar_itinerarios_admin();
}
// var total_Itinerarios=0;
// var Itis_precio=0;
// var nroPasajeros=2;
var lista_itinerarios1='';
function Pasar_datos1(){
    Itis_precio=parseFloat($('#totalItinerario').val());
    total_Itinerarios=$('#nroItinerario').val();
    var itinerario='';
    $("input[name=itinerarios]").each(function (index){
        if($(this).is(':checked')){
            $(this).prop("checked", "");
            total_Itinerarios++;
            itinerario=$(this).val().split('_');
            var precio_grupo=0;
            Itis_precio += parseFloat(itinerario[4]);
            console.log('Precios:'+Itis_precio);
            $.each(servicios, function( key, value ) {
                var serv=value.split('//');
                var val_p_g=parseFloat(serv[1]);
                // if(serv[2]==1)
                //     val_p_g=parseInt(Math.ceil(serv[1]/nroPasajeros));
                // precio_grupo+=val_p_g;
            });
            // if(parseInt(itinerario[4])==0) {
            //     Itis_precio += parseInt(itinerario[4]);
            //     precio_grupo=parseInt(itinerario[4]);
            // }
            // else if(parseInt(itinerario[4])==1){
            //     Itis_precio += Math.ceil(parseInt(itinerario[4])/nroPasajeros);
            //     precio_grupo=Math.ceil(parseInt(itinerario[4])/nroPasajeros);
            // }
            // console.log('cost: '+Itis_precio);
            var servicios=itinerario[5].split('*');
            // lista_itinerarios1+=itinerario[0]+'/';
            var iti_temp='';
            iti_temp+='<div id="itinerario_'+itinerario[0]+'" class="caja_itineario">'+
                    '<div class="row">'+
                    '<div class="col-lg-9">' +
                        '<input type="hidden" name="itinerarios_1[]" value="'+itinerario[5]+'">'+
                    '<input type="hidden" name="itinerarios_2[]" value="'+itinerario[0]+'">'+
                    '<span class="itinerarios_1 hide">'+itinerario[5]+'</span>'+
                        '<span class="txt_itinerarios hide" name="itinerarios1">'+itinerario[0]+'</span>'+
                        '<b class="dias" id="dias_"+total_Itinerarios+>Dia '+total_Itinerarios+':</b> '+itinerario[2]+
                    '</div>'+
                    '<div class="col-lg-3">' +
                        ' <b>'+itinerario[4]+'</b>'+
                        ' <a class="text-right" href="#!" onclick="borrar_iti('+itinerario[0]+')"><i class="fa fa-times-circle" aria-hidden="true"></i></a>'
                    '</div>'+
                    '</div>'+
                '</div>';

            $('#Lista_itinerario_g').append(iti_temp);

        }
    });
    $('#totalItinerario').val(Itis_precio);
    $('#st_new').html(Itis_precio);
    $('#nroItinerario').val(total_Itinerarios);
    // $('#lista_itinerarios1').val(lista_itinerarios1);

    calcular_resumen();
    calcular_precio1();
}
function calcular_precio1(){
    var preci_Total=0;
    var total_Itinerarios=$('#nroItinerario').val();
    var servio='';
    var serv='';
    var val_p='';
    var val_p_g='';
        $(".itinerarios_1").each(function (index) {
        servio=$(this).html().split('*');
        console.log('servicio:'+servio);
        $.each(servio, function( key, value ) {
                serv=value.split('//');
                console.log('serr:'+serv[2]);
                val_p=parseFloat(serv[2]);
                // val_p_g=parseInt(serv[3]);

                preci_Total+=val_p;
            });
    });
    var estrel=$('#estrellas_from').val();
    var precio_hotel=0;
    var a_s1=parseInt($('#a_s').val());
    var a_d1=parseInt($('#a_d').val());
    var a_m1=parseInt($('#a_m').val());
    var a_t1=parseInt($('#a_t').val());

    if(estrel=='2'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h2_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h2_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h2_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h2_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    if(estrel=='3'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h3_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h3_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h3_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h3_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    if(estrel=='4'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h4_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h4_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h4_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h4_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    if(estrel=='5'){
        if(a_s1>0){
            precio_hotel+=parseFloat($('#h5_s').val())*(parseInt($('#txt_days').val())-1)*a_s1;
        }
        if(a_d1>0){
            precio_hotel+=parseFloat($('#h5_d').val())*(parseInt($('#txt_days').val())-1)*a_d1;
        }
        if(a_m1>0){
            precio_hotel+=parseFloat($('#h5_m').val())*(parseInt($('#txt_days').val())-1)*a_m1;
        }
        if(a_t1>0){
            precio_hotel+=parseFloat($('#h5_t').val())*(parseInt($('#txt_days').val())-1)*a_t1;
        }
    }
    var total=0;
    total=preci_Total+precio_hotel;
    $('#st_new').html(total);
    console.log('precio itinerarios:'+preci_Total);
    console.log('precio hotel:'+precio_hotel);
    console.log('precio total:'+total);
}

function borrar_iti(id){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar este itinerario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#itinerario_'+id).fadeOut();
        $('#itinerario_'+id).remove();
        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);
    })

}

function ordenar_itinerarios1(){
    // var dia=1;
    // $(".dias").each(function (index) {
    //     $(this).html(dia);
    //     dia=dia+1;
    // });
    var total_Iti=$('#nroItinerario').val();
    var i=1;
    for(i;i<=total_Iti;i++){
        $('#dias_'+i).html(i);
    }
}
function filtrar_estrellas1(estrella){
    $('#estrellas').html(estrella+' STARS');
    $('#estrellas_').html(estrella+' STARS');

    $('#estrellas_from').val(estrella);
    $('#estrellas_from_').val(estrella);

    calcular_precio1();
    filtrar_itinerarios_admin();
}
function aumentar_acom(tipo,signo){
    // alert(tipo+':'+signo);
    if(tipo=='s'){
        if(signo=='-'){
            var valor=$('#a_s').val();
            valor--;
            if(valor<0)
                valor=0;
            $('#a_s').val(valor);
            $('#a_s_').val(valor);
            $('#a_s_1').html(valor);
        }
        else{
            var valor=$('#a_s').val();
            valor++;
            $('#a_s').val(valor);
            $('#a_s_').val(valor);
            $('#a_s_1').html(valor);
        }
    }
    if(tipo=='d'){
        // console.log('entro a d');
        if(signo=='-'){
            var valor=$('#a_d').val();
            valor--;
            // console.log(valor);
            if(valor<0)
                valor=0;
            $('#a_d').val(valor);
            $('#a_d_').val(valor);
            $('#a_d_1').html(valor);
        }
        else{
            var valor=$('#a_d').val();
            valor++;
            // console.log(valor);
            $('#a_d').val(valor);
            $('#a_d_').val(valor);
            $('#a_d_1').html(valor);
        }
    }
    if(tipo=='m'){
        if(signo=='-'){
            var valor=$('#a_m').val();
            valor--;
            if(valor<0)
                valor=0;
            $('#a_m').val(valor);
            $('#a_m_').val(valor);
            $('#a_m_1').html(valor);
        }
        else{
            var valor=$('#a_m').val();
            valor++;
            $('#a_m').val(valor);
            $('#a_m_').val(valor);
            $('#a_m_1').html(valor);
        }
    }
    if(tipo=='t'){
        if(signo=='-'){
            var valor=$('#a_t').val();
            valor--;
            if(valor<0)
                valor=0;
            $('#a_t').val(valor);
            $('#a_t_').val(valor);
            $('#a_t_1').html(valor);
        }
        else{
            var valor=$('#a_t').val();
            valor++;
            $('#a_t').val(valor);
            $('#a_t_').val(valor);
            $('#a_t_1').html(valor);
        }
    }
    calcular_precio1();
}
function enviar_form1(){
    $('#form_nuevo_pqt').submit(function() {
        // alert('holas');

        $('#txt_country1').val($('#txt_country').val());
        $('#txt_name1').val($('#txt_name').val());
        $('#txt_email1').val($('#txt_email').val());
        $('#txt_phone1').val($('#txt_phone').val());
        $('#txt_travelers1').val($('#txt_travellers').val());
        $('#txt_days1').val($('#txt_days').val());
        $('#txt_date1').val($('#txt_travel_date').val());
        $('#txt_destinos1').val(destinos);
        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);

        // destinos=destinos;
        console.log('hola '+name1);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    // $('#for_'+id).addClass('hide');
                    // $('#result_'+id).removeClass('text-danger');
                    // $('#result_'+id).addClass('text-success');
                    // $('#result_'+id).html('Pago guardado Correctamente!');
                }
                else{
                    // $('#result_'+id).removeClass('text-success');
                    // $('#result_'+id).addClass('text-danger');
                    // $('#result_'+id).html('Error al pagar, intentelo de nuevo');
                }
            }
        })
        // return false;
    });
}

function pasar_dias(){
    var dias=$('#txt_days').val();
    $('#dias_html').html(dias+'d');
}
function poner_dias() {
    $('#txt_days1').val($('#txt_days').val());
    $('#dias_html').html($('#txt_days').val()+'d');
    $('#dias_html_0').html($('#txt_days').val()+'d');

    calcular_precio1();
    filtrar_itinerarios_admin();
}

function variar_profit(acom) {
    var valor=parseFloat($('#cost_'+acom).html());
    var pro=parseFloat($('#pro_'+acom).val());
    var sale=Math.round(valor+pro);
    $('#sale_'+acom).html(sale);
    var profit_por=Math.round((pro/sale)*100,2);
    $('#porc_'+acom).html(profit_por);
    $('#porc_'+acom).val(profit_por);
    var sale_s=parseFloat($('#sale_s').html());
    var sale_d=parseFloat($('#sale_d').html());
    var sale_m=parseFloat($('#sale_m').html());
    var sale_t=parseFloat($('#sale_t').html());

    $('#total_profit').html(sale_s+sale_d+sale_m+sale_t);
    var pro_s=parseFloat($('#pro_s').val());
    var pro_d=parseFloat($('#pro_d').val());
    var pro_m=parseFloat($('#pro_m').val());
    var pro_t=parseFloat($('#pro_t').val());
    var uti_por_s=0;
    var uti_por_d=0;
    var uti_por_m=0;
    var uti_por_t=0;
    if(sale_s!=0)
        uti_por_d=Math.round((pro_s/sale_s)*100,0);
    if(sale_d!=0)
    var uti_por_d=Math.round((pro_d/sale_d)*100,0);
    if(sale_m!=0)
        var uti_por_m=Math.round((pro_m/sale_m)*100,0);
    if(sale_t!=0)
    var uti_por_t=Math.round((pro_t/sale_t)*100,0);

    console.log('uti_por_s:'+uti_por_s);
    console.log('uti_por_d:'+uti_por_d);
    console.log('uti_por_m:'+uti_por_m);
    console.log('uti_por_t:'+uti_por_t);

    $('#profit_por_s').val(uti_por_s);
    $('#profit_por_d').val(uti_por_d);
    $('#profit_por_m').val(uti_por_m);
    $('#profit_por_t').val(uti_por_t);
}
function filtrar_itinerarios_(){
    var dias_f=$('#txt_days').val();
    var estrellas=$('#estrellas_from').val();
    var desti_f='';
    var valorci1='';
    $("input[class='destinospack']").each(function (index) {
        if($(this).is(':checked')) {
            valorci1=$(this).val().split('_');
            desti_f+=valorci1[1]+'/';
        }
    });
    desti_f=desti_f.substr(0,desti_f.length-1);
    var pos=1;
    $("input[class='lista_itinerarios3']").each(function (index) {
        $('#itinerario3_'+pos).addClass('hide');
        pos++;
    });
    var pqt='';
    var pos1=1;
    $("input[class='lista_itinerarios3']").each(function (index) {
        pqt='';
        pqt=$(this).val().split('_');
        if(dias_f==pqt[1]){
            if(coinciden(desti_f,pqt[2])){
                $('#itinerario3_'+pos1).removeClass("hide");
            }
        }
        pos1++;
    });
}
function coinciden(escojidos,ofertados) {
    ofertados=ofertados.split('/');
    escojidos=escojidos.split('/');
    var p=0;
    for(var i=0;i<escojidos.length;i++) {
        if(ofertados.indexOf(escojidos[i])>=0)
            p++;
    }
    if(p==escojidos.length)
        return true;
    else
        return false;
}
function filtrar_itinerarios_admin(){
    $('#caja_load').removeClass("hide");
    filtrar_itinerarios_();
    setTimeout(function(){
        $('#caja_load').addClass("hide");
    }, 3000);
}
function mostrar_datos(cadena) {
    var datos_pqt=cadena.split('_');
    // console.log('datos_pqt:'+datos_pqt);
    $('#pqt_id').val(datos_pqt[0]);

    // var cadena_pqt=$('#datos_paquete_'+datos_pqt[0]).val();
    //
    // var precio_t_iti=parseFloat(datos_pqt[2]);
    // var estella=$('#estrellas_from').val();
    // console.log('cadena_pqt:'+cadena_pqt);
    // console.log('precio_t_iti:'+precio_t_iti);
    // console.log('estella:'+estella);
    //
    // var a_s0=parseInt($('#a_s').val());
    // var a_d0=parseInt($('#a_d').val());
    // var a_m0=parseInt($('#a_m').val());
    // var a_t0=parseInt($('#a_t').val());
    // console.log('a_s0:'+a_s0);
    // console.log('a_d0:'+a_d0);
    // console.log('a_m0:'+a_m0);
    // console.log('a_t0:'+a_t0);
    //
    // var precio_hotel_s=0;
    // var precio_hotel_d=0;
    // var precio_hotel_m=0;
    // var precio_hotel_t=0;
    // cadena_pqt=cadena_pqt.split('/');
    // if(estella==2) {
    //     var v_star_2=cadena_pqt[0];
    //     v_star_2=v_star_2.split('_');
    //     console.log('v_star_2:'+v_star_2);
    //     if (a_s0 > 0) {
    //         precio_hotel_s +=parseFloat(v_star_2[0]);
    //     }
    //     if (a_d0 > 0) {
    //         precio_hotel_d +=parseFloat(v_star_2[1]);
    //     }
    //     if (a_m0 > 0) {
    //         precio_hotel_m +=parseFloat(v_star_2[2]);
    //     }
    //     if (a_t0 > 0) {
    //         precio_hotel_t +=parseFloat(v_star_2[3]);
    //     }
    //     console.log('a_s0:'+a_s0);
    //     console.log('a_d0:'+a_d0);
    //     console.log('a_m0:'+a_m0);
    //     console.log('a_t0:'+a_t0);
    //
    // }
    // if(estella==3) {
    //     var v_star_3=cadena_pqt[1];
    //     v_star_2=v_star_3.split('_');
    //     console.log('v_star_2:'+v_star_2);
    //     if (a_s0 > 0) {
    //         precio_hotel_s +=parseFloat(v_star_2[0]);
    //     }
    //     if (a_d0 > 0) {
    //         precio_hotel_d +=parseFloat(v_star_2[1]);
    //     }
    //     if (a_m0 > 0) {
    //         precio_hotel_m +=parseFloat(v_star_2[2]);
    //     }
    //     if (a_t0 > 0) {
    //         precio_hotel_t +=parseFloat(v_star_2[3]);
    //     }
    //     console.log('a_s0:'+a_s0);
    //     console.log('a_d0:'+a_d0);
    //     console.log('a_m0:'+a_m0);
    //     console.log('a_t0:'+a_t0);
    // }
    // if(estella==4) {
    //     var v_star_3=cadena_pqt[2];
    //     v_star_2=v_star_3.split('_');
    //     console.log('v_star_2:'+v_star_2);
    //     if (a_s0 > 0) {
    //         precio_hotel_s +=parseFloat(v_star_2[0]);
    //     }
    //     if (a_d0 > 0) {
    //         precio_hotel_d +=parseFloat(v_star_2[1]);
    //     }
    //     if (a_m0 > 0) {
    //         precio_hotel_m +=parseFloat(v_star_2[2]);
    //     }
    //     if (a_t0 > 0) {
    //         precio_hotel_t +=parseFloat(v_star_2[3]);
    //     }
    //     console.log('a_s0:'+a_s0);
    //     console.log('a_d0:'+a_d0);
    //     console.log('a_m0:'+a_m0);
    //     console.log('a_t0:'+a_t0);
    // }
    // if(estella==5) {
    //     var v_star_3=cadena_pqt[3];
    //     v_star_2=v_star_3.split('_');
    //     console.log('v_star_2:'+v_star_2);
    //     if (a_s0 > 0) {
    //         precio_hotel_s +=parseFloat(v_star_2[0]);
    //     }
    //     if (a_d0 > 0) {
    //         precio_hotel_d +=parseFloat(v_star_2[1]);
    //     }
    //     if (a_m0 > 0) {
    //         precio_hotel_m +=parseFloat(v_star_2[2]);
    //     }
    //     if (a_t0 > 0) {
    //         precio_hotel_t +=parseFloat(v_star_2[3]);
    //     }
    //     console.log('a_s0:'+a_s0);
    //     console.log('a_d0:'+a_d0);
    //     console.log('a_m0:'+a_m0);
    //     console.log('a_t0:'+a_t0);
    // }
    // precio_hotel_s+=precio_t_iti;
    // precio_hotel_d+=precio_t_iti;
    // precio_hotel_m+=precio_t_iti;
    // precio_hotel_t+=precio_t_iti;
    //
    // console.log('precio_hotel_s:'+precio_hotel_s);
    // console.log('precio_hotel_d:'+precio_hotel_d);
    // console.log('precio_hotel_m:'+precio_hotel_m);
    // console.log('precio_hotel_t:'+precio_hotel_t);
    //
    // console.log('total_precio:'+total_precio);


    // var total_precio=parseFloat(precio_hotel_s)+parseFloat(precio_hotel_d)+parseFloat(precio_hotel_m)+parseFloat(precio_hotel_t);

    // $('#precio_plantilla').html('$'+total_precio);
    // console.log('precio unitario {2}:'+datos_pqt);
    // $('#precio_plantilla').html('$'+datos_pqt[2]);
    sumar_servicios_itinerario();
}
function enviar_form2(){
    $('#form_nuevo_pqt_').submit(function() {
        // alert('holas');

        $('#txt_country1_').val($('#txt_country').val());
        $('#txt_name1_').val($('#txt_name').val());
        $('#txt_email1_').val($('#txt_email').val());
        $('#txt_phone1_').val($('#txt_phone').val());
        $('#txt_travelers1_').val($('#txt_travellers').val());
        $('#txt_days1_').val($('#txt_days').val());
        $('#txt_date1_').val($('#txt_travel_date').val());
        $('#txt_destinos1_').val(destinos);

        // $.ajax({
        //     type: 'POST',
        //     url: $(this).attr('action'),
        //     data: $(this).serialize(),
        //     // Mostramos un mensaje con la respuesta de PHP
        //     success: function(data) {
        //         if(data==1){
        //         }
        //         else{
        //         }
        //     }
        // })
        // return false;
    });
}

function borrar_serv_quot_paso1(id,servicio){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el "+servicio+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/quotes/servicio/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_servicios_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
    calcularPrecio();
}
function calcularPrecio(){
    var total_serv_s=0;
    var total_serv_d=0;
    var total_serv_t=0;
    console.log('precio_servicio_s:');
    $("input[class='precio_servicio_s']").each(function (index) {
        total_serv_s+=parseFloat($(this).val());
        console.log('precio_servicio_s:'+$(this).val());
    });
    $("input[class='precio_servicio_s_h']").each(function (index) {
        total_serv_s+=parseFloat($(this).val());
        console.log('precio_servicio_s_h:'+$(this).val());
    });
    console.log('total_serv_s:'+total_serv_s);
    $("input[class='precio_servicio_d']").each(function (index) {
        total_serv_d+=parseFloat($(this).val());
        console.log('precio_servicio_d:'+$(this).val());
    });
    $("input[class='precio_servicio_d_h']").each(function (index) {
        total_serv_d+=parseFloat($(this).val());
        console.log('precio_servicio_d:'+$(this).val());
    });
    console.log('total_serv_d:'+total_serv_d);
    $("input[class='precio_servicio_t']").each(function (index) {
        total_serv_t+=parseFloat($(this).val());
        console.log('precio_servicio_t:'+$(this).val());
    });
    $("input[class='precio_servicio_t_h']").each(function (index) {
        total_serv_t+=parseFloat($(this).val());
        console.log('precio_servicio_t:'+$(this).val());
    });
    console.log('total_serv_t:'+total_serv_t);


    precio_servicio_s_h
    $("#cost_s").html(total_serv_s);
    $("#cost_d").html(total_serv_d);
    $("#cost_t").html(total_serv_t);
}

function sumar_servicios_itinerario(){
    console.log('hola');
    var pqt=$('#pqt_id').val();
    var arreglo
    arreglo=$('#lista_servicios_'+pqt).val().split('/');
    var dat='';
    var suma=0;
    var traveles=0;
    traveles=$('#txt_travellers').val();
    console.log('traveles:'+traveles);
    console.log('servicios:'+arreglo);

    $.each(arreglo, function( key, value ) {
        dat=value.split('_');
        if(dat[1]=='g'){
            suma+=Math.round((dat[0]/traveles)*10)/10;
            console.log('v:'+Math.round((dat[0]/traveles)*10)/10);
        }
        else if(dat[1]=='i'){
            suma+=Math.round(dat[0]*10)/10;
            console.log('v:'+Math.round(dat[0]*10)/10);
        }

    });
    suma=Math.ceil(suma);
    $('#precio_plantilla').html(suma);
}

function MostrarDatos(){
    var datos=$('#txt_name').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/cliente/mostrar', 'id='+datos, function(data) {
        console.log(data);
        var dat=data.split('_');
        console.log(dat);
        if(dat[0]==1){
            $("#txt_country").val(dat[1]);
            $("#txt_email").val(dat[2]);
            $("#txt_phone").val(dat[3]);
            $("#txt_travellers").val(dat[4]);
            $("#txt_days").val(dat[5]);
            $("#txt_travel_date").val(dat[6]);
            $("#cotizacion_id_").val(dat[7]);
            $("#cliente_id_").val(dat[8]);
            $("#plan").val('1');
        }
    }).fail(function (data) {
    });
}
function runScript(event) {
    if (event.which == 13 || event.keyCode == 13) {
        console.log('se presiono enter');
        MostrarDatos();
        // var tb = document.getElementById("scriptBox");
        // eval(tb.value);
        // return false;
    }
}

