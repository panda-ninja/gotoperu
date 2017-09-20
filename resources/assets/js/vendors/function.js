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
                total_ci += parseInt(dato1[1]);
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