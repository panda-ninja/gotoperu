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
    $("input[class='itinerario']").each(function (index){
        if($(this).is(':checked')){
            itinerario=$(this).val().split('_');
            if(!existe(itinerario[0])) {
                total_Itinerarios++;
                var precio_grupo=0;
                Itis_precio += parseFloat(itinerario[4]);
                console.log('Precios:'+Itis_precio);
                var servicios=itinerario[5].split('*');
            $.each(servicios, function( key, value ) {
                var serv=value.split('//');
                var val_p_g=parseFloat(serv[1]);
            });
            var iti_temp='';
                    iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '" value="' + itinerario[0] + '">' +
                    '<div class="content-list-book-s">' +
                    '<a href="#!">' +
                    '<strong>' +
                    '<input type="hidden" class="servicios_new" name="servicios_new_'+itinerario[0]+'" value="' + itinerario[0] + '">' +
                    '<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">' +
                    '<input type="hidden" name="itinerarios_1[]" value="' + itinerario[5] + '">' +
                    '<input type="hidden" name="itinerarios_2[]" value="' + itinerario[0] + '">' +
                    '<span class="itinerarios_1 hide">' + itinerario[5] + '</span>' +
                    '<span class="txt_itinerarios hide" name="itinerarios1">' + itinerario[0] + '</span>' +
                    '<b class="dias_iti_c2" id="dias_' + total_Itinerarios + '">Dia ' + total_Itinerarios + ':</b> ' + itinerario[2] +
                    '</strong>' +
                    '<small>' +
                    itinerario[4] + '$' +
                    '</small>' +
                    '</a>' +
                    '<div class="icon">' +
                    ' <a class="text-right" href="#!" onclick="eliminar_iti(' + itinerario[0] + ',' + itinerario[4] + ')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'
                '</div>' +
                '</div>' +
                '</li>';
            $('#Lista_itinerario_g').append(iti_temp);
            }
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

function eliminar_servicio(local,id,servicio) {
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
}
function eliminar_producto(id,servicio) {
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
        console.log('mostrando');
    }
    else if(desicion==1){
        desicion=0;
        $("#modal_new_cost").addClass('hide');
        $("#modal_new_cost").fadeOut( "slow");
        console.log('ocultando');
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
    $("input[class='servicios']").each(function (index1) {
        var dato3 = $(this).val();
        var servicio3 = dato3.split('_');
        var esta=0;
        $("input[class='grupo']").each(function (index) {
            if($(this).is(':checked')) {
                var dato = $(this).val();
                var destino1 = dato.split('_');
                if(destino1[1] == servicio3[3]) {/*-- si el destino es igual al destino que tiene el servicio*/
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
                $('#service_edit_'+itinerario+'_'+servicio3[2]).addClass("hide");
                $('#service_edit_'+itinerario+'_'+servicio3[2]).fadeOut("slow");
                console.log('borrando:'+'#service_edit_'+itinerario+'_'+servicio3[2]);
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
    var destino1 =$('#desti').val().split('/');
    //
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
            $('#group_destino_'+valorci[0]).removeClass("hide");
            $('#group_destino_'+valorci[0]).fadeIn("slow");

        }
    });
    destinos=destinos.substr(0,destinos.length-1);
    $('#desti').val(destinos);


}

function eliminar_iti(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar este itinerario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#content-list-'+id).fadeOut();
        $('#content-list-'+id).remove();
        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);
        var valor_temp=parseFloat($('#totalItinerario').val());
        valor_temp=valor_temp-valor;
        $('#totalItinerario').val(valor_temp);
        $('#totalItinerario_front').html(valor_temp);

        var cont=0;
        $(".dias_iti_c2").each(function (index) {
            cont++;
            $(this).html('Dia '+cont+':');
        });
        console.log('cont:'+cont);
        $('#nroItinerario').val(cont);
        calcular_resumen();
    })
}

function calcular_utilidad(){
    var $totalItinerario=$('#totalItinerario').val();
    var $txt_day=Math.ceil($('#txt_day').val()-1);
    var $txt_utilidad=$('#txt_utilidad').val();
    var $preciox_n_dias=$totalItinerario*($txt_day-1);
    var $utilidad1=parseFloat($txt_utilidad)*parseFloat(0.01);
    var $preciox_n_dias_venta=$preciox_n_dias+Math.round($preciox_n_dias*$utilidad1);
    $('#totalItinerario_venta').val($preciox_n_dias_venta);
}
function eliminar_categoria1(id,categoria) {
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

    if($('#tipo_plantilla').val()=='si') {
        var dias_1=$('#txt_day').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('/admin/package/gererar-codigo', 'duracion='+dias_1 , function (data) {
            $('#txt_codigo').val(data);
        }).fail(function (data) {
        });
    }
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
                var $nro_planes=parseInt($('#nro_planes').val());
                for(var $d=0;$d<$nro_planes;$d++){
                    $('#plan_'+$d).prop('onclick',null);
                    $('#plan_'+$d).unbind( "click" );
                }

                $('#plan_'+plan).removeClass('btn-danger');
                $('#plan_'+plan).addClass('btn-success');

            }
            else if(data==2){

            }
        }).fail(function (data) {
        });

    }, function (dismiss) {
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
            // $('#S_2').val(data1[1]);
            // $('#D_2').val(data1[2]);
            // $('#M_2').val(data1[3]);
            // $('#T_2').val(data1[4]);
            // $('#SS_2').val(data1[5]);
            // $('#SD_2').val(data1[6]);
            // $('#SU_2').val(data1[7]);
            // $('#JS_2').val(data1[8]);
            $('#hotel_id_3').val(data1[9]);
            // $('#S_3').val(data1[10]);
            // $('#D_3').val(data1[11]);
            // $('#M_3').val(data1[12]);
            // $('#T_3').val(data1[13]);
            // $('#SS_3').val(data1[14]);
            // $('#SD_3').val(data1[15]);
            // $('#SU_3').val(data1[16]);
            // $('#JS_3').val(data1[17]);
            $('#hotel_id_4').val(data1[18]);
            // $('#S_4').val(data1[19]);
            // $('#D_4').val(data1[20]);
            // $('#M_4').val(data1[21]);
            // $('#T_4').val(data1[22]);
            // $('#SS_4').val(data1[23]);
            // $('#SD_4').val(data1[24]);
            // $('#SU_4').val(data1[25]);
            // $('#JS_4').val(data1[26]);
            $('#hotel_id_5').val(data1[27]);
            // $('#S_5').val(data1[28]);
            // $('#D_5').val(data1[29]);
            // $('#M_5').val(data1[30]);
            // $('#T_5').val(data1[31]);
            // $('#SS_5').val(data1[32]);
            // $('#SD_5').val(data1[33]);
            // $('#SU_5').val(data1[34]);
            // $('#JS_5').val(data1[35]);
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
                $("#lista_services_h_"+id).fadeOut( "low");
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
                // $("#coti_new"+id).fadeOut( "slow");
                $('#content-list-'+id).addClass('hide');
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
function existe(clave){
    var existe=false;
    $("input[class='servicios_new']").each(function (index1) {
        if(clave==$(this).val()){
            existe=true;
        }
    });
    return existe;
}
 var total_Itinerarios_camino2=0;
// var Itis_precio=0;
// var nroPasajeros=2;
var lista_itinerarios1='';
function Pasar_datos1(){
    Itis_precio=parseFloat($('#totalItinerario').val());
    total_Itinerarios_camino2=$('#nroItinerario').val();
    var itinerario='';
    $("input[name='itinerarios']").each(function (index){
        if($(this).is(':checked')){
            itinerario=$(this).val().split('_');
            if(!existe(itinerario[0])) {
                total_Itinerarios_camino2++;
                var precio_grupo = 0;
                Itis_precio += parseFloat(itinerario[4]);
                console.log('Precios:' + Itis_precio);
                $.each(servicios, function (key, value) {
                    var serv = value.split('//');
                    var val_p_g = parseFloat(serv[1]);
                });
                var servicios = itinerario[5].split('*');
                var iti_temp = '';

                iti_temp += '<li class="content-list-book" id="content-list-' + itinerario[0] + '" value="' + itinerario[0] + '">' +
                    '<div class="content-list-book-s">' +
                    '<a href="#!">' +
                    '<strong>' +
                    '<input type="hidden" class="servicios_new" name="servicios_new_" value="' + itinerario[0] + '">' +
                    '<img src="https://assets.pipedrive.com/images/icons/profile_120x120.svg" alt="">' +
                    // '<input type="hidden" name="itinerarios_1[]" value="' + itinerario[5] + '">' +
                    '<input type="hidden" name="itinerarios_2[]" value="' + itinerario[0] + '">' +
                    '<span class="itinerarios_1 hide">' + itinerario[5] + '</span>' +
                    '<span class="txt_itinerarios hide" name="itinerarios1">' + itinerario[0] + '</span>' +
                    '<b class="dias_iti_c2" id="dias_' + total_Itinerarios_camino2 + '">Dia ' + total_Itinerarios_camino2 + ':</b> ' + itinerario[2] +
                    '</strong>' +
                    '<small>' +
                    itinerario[4] + '$' +
                    '</small>' +
                    '</a>' +
                    '<div class="icon">' +
                    ' <a class="text-right" href="#!" onclick="borrar_iti(' + itinerario[0] + ',' + itinerario[4] + ')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>'
                '</div>' +
                '</div>' +
                '</li>';

                $('#Lista_itinerario_g').append(iti_temp);
            }
        }
    });
    $('#totalItinerario').val(Itis_precio);
    $('#st_new').html(Itis_precio);
    $('#nroItinerario').val(total_Itinerarios_camino2);
    calcular_resumen();
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

function borrar_iti(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar este itinerario?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#content-list-'+id).fadeOut();
        $('#content-list-'+id).remove();
        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);
        var valor_temp=parseFloat($('#totalItinerario').val());
        valor_temp=valor_temp-valor;
        $('#totalItinerario').val(valor_temp);
        $('#st_new').html(valor_temp);

        var cont=0;
        $(".dias_iti_c2").each(function (index) {
            cont++;
            $(this).html('Dia '+cont+':');
        });
        console.log('cont:'+cont);
        $('#nroItinerario').val(cont);
    })
}

function ordenar_itinerarios1(){
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
function comprobar_dist_acom(){
    var total_com=(parseInt($('#a_s_1').val())*1)+(parseInt($('#a_d_1').val())*2)+(parseInt($('#a_m_1').val())*2)+(parseInt($('#a_t_1').val())*3);
    var total_paxs=$('#txt_travellers').val();
    if(total_com>total_paxs){
        swal(
            'Oops...',
            'La configuracion de la acomodacion excede la cantidad de paxs!',
            'error'
        )
    }
    else if(total_com<total_paxs){
        swal(
            'Oops...',
            'La configuracion de la acomodacion es menor a la cantidad de paxs!',
            'error'
        )
    }
}
function aumentar_acom(tipo,signo){

    if(tipo=='s'){
            var valor=$('#a_s_1').val();

            $('#a_s').val(valor);
            $('#a_s_').val(valor);
        console.log('con cambio para s');
    }
    if(tipo=='d'){
            var valor=$('#a_d_1').val();

            $('#a_d').val(valor);
            $('#a_d_').val(valor);
        console.log('con cambio para d');
    }
    if(tipo=='m'){
            var valor=$('#a_m_1').val();
            $('#a_m').val(valor);
            $('#a_m_').val(valor);
        console.log('con cambio para m');
    }
    if(tipo=='t'){
            var valor=$('#a_t_1').val();
            $('#a_t').val(valor);
            $('#a_t_').val(valor);
        console.log('con cambio para t');
    }
    //calcular_precio1();
}
function enviar_form1(){
    $('#form_nuevo_pqt').submit(function() {
        $('#txt_country1').val($('#txt_country').val());
        $('#txt_name1').val($('#txt_name').val());
        $('#txt_email1').val($('#txt_email').val());
        $('#txt_phone1').val($('#txt_phone').val());
        $('#txt_travelers1').val($('#txt_travellers').val());
        $('#txt_days1').val($('#txt_days').val());
        $('#txt_date1').val($('#txt_travel_date').val());
        $('#web1').val($('#web').val());
        $('#txt_destinos1').val(destinos);

        if($('#txt_name1').val()==''){
            $('#txt_name1').focus();
            swal(
                'Oops...',
                'Ingrese el nombre!',
                'error'
            )
            return false;
        }
        if($('#txt_country1').val()==''){
            $('#txt_country1').focus();
            swal(
                'Oops...',
                'Ingrese la nacionalidad!',
                'error'
            )
            return false;
        }
        if($('#txt_email1').val()==''){
            $('#txt_email1').focus();
            swal(
                'Oops...',
                'Ingrese el email!',
                'error'
            )
            return false;
        }
        // if($('#txt_phone1').val()==''){
        //     $('#txt_phone1').focus();
        //     swal(
        //         'Oops...',
        //         'Ingrese el telefono!',
        //         'error'
        //     )
        //     return false;
        // }
        if($('#txt_travelers1').val()==0){
            $('#txt_travelers1').focus();
            swal(
                'Oops...',
                'Ingrese el numero de pasajeros!',
                'error'
            )
            return false;
        }
        if($('#txt_days1').val()==0){
            $('#txt_days1').focus();
            swal(
                'Oops...',
                'Ingrese el umero de dias!',
                'error'
            )
            return false;
        }
        if($('#txt_date1').val()==''){
            $('#txt_date1').focus();
            swal(
                'Oops...',
                'Ingrese la fecha de viaje!',
                'error'
            )
            return false;
        }
        if($('#txt_destinos1').val()==''){
            $('#txt_destinos1').focus();
            swal(
                'Oops...',
                'Escoja los destinos!',
                'error'
            )
            return false;
        }

        var a_s=parseInt($('#a_s').val());
        var a_d=parseInt($('#a_d').val());
        var a_m=parseInt($('#a_m').val());
        var a_t=parseInt($('#a_t').val());

        var a_total_=a_s+a_d+a_m+a_t;
        if(a_total_==0){
            swal(
                'Oops...',
                'Escoja la acomodacion!',
                'error'
            )
            return false;
        }

        var lista_it='';
        $(".txt_itinerarios").each(function (index) {
            lista_it+=$(this).html()+'/';
        });
        $('#lista_itinerarios1').val(lista_it);
        if(lista_it==''){
            swal(
                'Oops...',
                'Escoja el itinerario!',
                'error'
            )
            return false;
        }
    });
}

function pasar_dias(){
    var dias=$('#txt_days').val();
    $('#dias_html').html(dias+'d');
}
function poner_dias() {
    $('#txt_days1').val($('#txt_days').val());
    $('#dias3').html($('#txt_days').val());
    $('#dias_html').html($('#txt_days').val()+'d');
    $('#dias_html_0').html($('#txt_days').val()+'d');

    //calcular_precio1();
    filtrar_itinerarios_admin();
    comprobar_dist_acom();
}

function variar_profit(acom) {
    var valor=parseFloat($('#cost_'+acom).html());
    var pro=parseFloat($('#pro_'+acom).val());
    var sale=Math.round(valor+pro);
    $('#sale_'+acom).val(sale);
    var profit_por=Math.round((pro/sale)*100,2);
    $('#porc_'+acom).html(profit_por);
    $('#porc_'+acom).val(profit_por);
    var sale_s=parseFloat($('#sale_s').val());
    var sale_d=parseFloat($('#sale_d').val());
    var sale_m=parseFloat($('#sale_m').val());
    var sale_t=parseFloat($('#sale_t').val());

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
function variar_sales(acom){


    var valor=parseFloat($('#cost_'+acom).html());
    var sale=parseFloat($('#sale_'+acom).val());
    var pro=Math.round(sale-valor);
    $('#pro_'+acom).val(pro);
    var profit_por=Math.round((pro/sale)*100,2);
    $('#porc_'+acom).html(profit_por);
    $('#porc_'+acom).val(profit_por);
    var sale_s=parseFloat($('#sale_s').val());
    var sale_d=parseFloat($('#sale_d').val());
    var sale_m=parseFloat($('#sale_m').val());
    var sale_t=parseFloat($('#sale_t').val());

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
        for(var i=2;i<=5;i++){
            $('#itinerario3_'+i+'_'+pos).addClass('hide');
            pos++;
        }
    });
    var pqt='';
    var pos1=1;
    $("input[class='lista_itinerarios3']").each(function (index) {
        pqt='';
        pqt=$(this).val().split('_');
        if(dias_f==pqt[1]){
            if(coinciden(desti_f,pqt[2])){
                console.log('coinciden E:'+desti_f+' O:'+pqt[2]);
                $('#itinerario3_'+estrellas+'_'+pos1).removeClass("hide");
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
var paquete_id_21=0;
function mostrar_datos(cadena) {
    var datos_pqt=cadena.split('_');
    $('#pqt_id').val(datos_pqt[0]);
    paquete_id_21=datos_pqt[3];
    sumar_servicios_itinerario(datos_pqt[3]);
}
function calcular_sumar_servicios(paxs){
    var resto=paxs;
    var t=0;
    var d=0;
    var s=0;
    if(paxs==6){
        t=0;
        d=3;
        s=0;
    }
    else if(paxs==8){
        t=0;
        d=4;
        s=0;
    }
    else {
        if (resto > 0) {
            t = parseInt(resto / 3);
            resto = resto % 3;
        }
        if (resto > 0) {
            d = parseInt(resto / 2);
            resto = resto % 2;
        }
        if (resto > 0) {
            s = parseInt(resto / 1);
            resto = resto % 1;
        }
    }
    $('#a_s_1').min = 0;
    $('#a_s_1').max = paxs/1;
    $('#a_s_1').val(s);

    $('#a_d_1').min = 0;
    $('#a_d_1').max = paxs/2;
    $('#a_d_1').val(d);

    $('#a_t_1').min = 0;
    $('#a_t_1').max = t;
    $('#a_t_1').val(t);
    sumar_servicios_itinerario(paquete_id_21);
    aumentar_acom('s');
    aumentar_acom('d');
    aumentar_acom('m');
    aumentar_acom('t');


}
function validar_envio(){
    console.log('hola ');
    $('#generar_plantilla').submit(function() {

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then(function () {
            if (true) {
            $('#generar_plantilla').submit(function() {
              return true;
            });

        } else if (resultado.dismiss === 'cancel') {
            return false;
        }
    })
        return false;
    });
}
function enviar_form2(){
    $('#form_nuevo_pqt_').submit(function() {
        $('#txt_country1_').val($('#txt_country').val());
        $('#txt_name1_').val($('#txt_name').val());
        $('#txt_email1_').val($('#txt_email').val());
        $('#txt_phone1_').val($('#txt_phone').val());
        $('#txt_travelers1_').val($('#txt_travellers').val());
        $('#txt_days1_').val($('#txt_days').val());
        $('#txt_date1_').val($('#txt_travel_date').val());
        $('#web_').val($('#web').val());
        $('#txt_destinos1_').val(destinos);
        if($('#txt_name1_').val()==''){
            $('#txt_name1_').focus();
            swal(
                'Oops...',
                'Ingrese el nombre!',
                'error'
            )
            return false;
        }
        if($('#txt_country1_').val()==''){
            $('#txt_country1_').focus();
            swal(
                'Oops...',
                'Ingrese la nacionalidad!',
                'error'
            )
            return false;
        }
        if($('#txt_email1_').val()==''){
            $('#txt_email1_').focus();
            swal(
                'Oops...',
                'Ingrese el email!',
                'error'
            )
            return false;
        }
        // if($('#txt_phone1_').val()==''){
        //     $('#txt_phone1_').focus();
        //     swal(
        //         'Oops...',
        //         'Ingrese el telefono!',
        //         'error'
        //     )
        //     return false;
        // }
        if($('#txt_travelers1_').val()==0){
            $('#txt_travelers1_').focus();
            swal(
                'Oops...',
                'Ingrese el numero de pasajeros!',
                'error'
            )
            return false;
        }
        if($('#txt_days1_').val()==0){
            $('#txt_days1_').focus();
            swal(
                'Oops...',
                'Ingrese el umero de dias!',
                'error'
            )
            return false;
        }
        if($('#txt_date1_').val()==''){
            $('#txt_date1_').focus();
            swal(
                'Oops...',
                'Ingrese la fecha de viaje!',
                'error'
            )
            return false;
        }
        if($('#txt_destinos1_').val()==''){
            $('#txt_destinos1_').focus();
            swal(
                'Oops...',
                'Escoja los destinos!',
                'error'
            )
            return false;
        }

        var a_s_=parseInt($('#a_s_').val());
        var a_d_=parseInt($('#a_d_').val());
        var a_m_=parseInt($('#a_m_').val());
        var a_t_=parseInt($('#a_t_').val());

        var a_total=a_s_+a_d_+a_m_+a_t_;
        if(a_total==0){

            swal(
                'Oops...',
                'Escoja la acomodacion!',
                'error'
            )
            return false;
        }
        var pqt_id=parseInt($('#pqt_id').val());
        if(pqt_id==0) {
            swal(
                'Oops...',
                'Escoja el paquete!',
                'error'
            )
            return false;
        }
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
                $("#lista_servicios_"+id).fadeOut( "slow");
                $("#lista_servicios_"+id).remove();
                calcularPrecio();
            }
        }).fail(function (data) {

        });

    })

}
function borrar_hotel_quot_paso1(id,dia){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar hotel para el dia "+dia+"?",
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
        $.post('/admin/quotes/hotel/delete', 'id='+id, function(data) {
            if(data==1){
                $("#caja_detalle_"+id).fadeOut( "slow");
                $("#caja_detalle_"+id).remove();
                calcularPrecio();
            }
        }).fail(function (data) {

        });

    })
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
        console.log('precio_servicio_d_h:'+$(this).val());
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
    total_serv_s=total_serv_s.toFixed(2);
    total_serv_d=total_serv_d.toFixed(2);
    total_serv_t=total_serv_t.toFixed(2);

    console.log('total_serv_t:'+total_serv_t);
    $("#cost_s").html(total_serv_s);
    $("#cost_d").html(total_serv_d);
    $("#cost_t").html(total_serv_t);
}

function sumar_servicios_itinerario(pqt_pos){
    var traveles=0;
    traveles=$('#txt_travellers').val();
    if(traveles<=0){
        swal(
            'Upps!',
            'Ingrese el nro de pasajeros!',
            'danger'
        )
        $('#pqt_'+pqt_pos).prop('checked', false);
        return false;
    }
    var icon_human='';
    if(traveles<=7){
        for (var i=1;i<=traveles;i++){
            icon_human+='<i class="fa fa-male fa-2x" aria-hidden="true"></i> ';
        }
    }
    else{
        icon_human='<i class="fa fa-male fa-2x" aria-hidden="true"></i> x '+traveles;
    }
    $('#human').html(icon_human);
    console.log('hola');
    var pqt=$('#pqt_id').val();
    var arreglo='';
    var valorcito=$('#lista_servicios_'+pqt_pos).val();
    console.log('valorcito:'+valorcito);
    if(valorcito){
        arreglo = valorcito.split('/');
    }
    var dat='';
    var suma=0;


    console.log('traveles:'+traveles);
    console.log('servicios:'+arreglo);

    $.each(arreglo, function( key, value ) {
        dat=value.split('_');

        if(dat[1]=='g'){
            suma+=Math.round((parseFloat(dat[0])/traveles)*10)/10;
            console.log('v:'+Math.round((parseFloat(dat[0])/traveles)*10)/10);
        }
        else if(dat[1]=='i'){
            suma+=Math.round(parseFloat(dat[0])*10)/10;
            console.log('v:'+Math.round(parseFloat(dat[0])*10)/10);
        }

    });
    console.log('suma:'+suma);
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

function escojer_pqt(id) {
    console.log(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/pqt/escojer', 'id='+id, function(data) {

    }).fail(function (data) {
    });
}

function mostrar_tabla_destino(grupo,id){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id, function(data) {
        $("#tb_datos_"+grupo).html(data);

    }).fail(function (data) {
    });
}

function escojerPos_edit(daybyday,pos,cate) {
    $("#posTipo").val(pos);
    mostrar_pivot_edit(daybyday,cate);
}
function mostrar_pivot_edit(daybyday,cate){
    console.log('Escojiste:'+cate);
    $("#t_edit_"+daybyday+"_TOURS").addClass('hide');
    $("#t_edit_"+daybyday+"_MOVILID").addClass('hide');
    $("#t_edit_"+daybyday+"_REPRESENT").addClass('hide');
    $("#t_edit_"+daybyday+"_ENTRANCES").addClass('hide');
    $("#t_edit_"+daybyday+"_FOOD").addClass('hide');
    $("#t_edit_"+daybyday+"_TRAINS").addClass('hide');
    $("#t_edit_"+daybyday+"_FLIGHTS").addClass('hide');
    $("#t_edit_"+daybyday+"_OTHERS").addClass('hide');
    $("#t_edit_"+daybyday+"_"+cate).removeClass('hide');
}

function guardar_obs_servicio(id){
    var obs_=$("#obs_"+id).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/operaciones/observacion', 'obs='+obs_+'&id='+id, function(data) {
        $("#rpt_"+id).html(data);
        if(data=='1'){
            $("#rpt_"+id).removeClass('text-danger');
            $("#rpt_"+id).removeClass('text-success');
            $("#rpt_"+id).addClass('text-success');
            $("#rpt_"+id).html('Observacion guardada correctamente!');
        }
        else{
            $("#rpt_"+id).removeClass('text-danger');
            $("#rpt_"+id).removeClass('text-success');
            $("#rpt_"+id).addClass('text-danger');
            $("#rpt_"+id).html('Error al guardar la observacion, intentelo de nuevo!');
        }

    }).fail(function (data) {
    });
}

function CierraPopup(id) {
    $("#myModal_serv"+id).modal('hide');//ocultamos el modal
    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
    $('.modal-backdrop').remove();//eliminamos el backdrop del modal
}
function segunda_confirmada(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de reconfirmar este servicio?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var confi2_v_=$("#confi2_v_"+id).val();
        console.log('hola:'+confi2_v_);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../../admin/operaciones/segunda-confirmada', 'confi2='+confi2_v_+'&id='+id, function(data) {
            $("#rpt_"+id).html(data);
            if(data=='1'){
                if(confi2_v_=='1'){
                    $("#confi2_"+id).removeClass('text-grey-goto');
                    $("#confi2_"+id).removeClass('text-success');
                    $("#confi2_"+id).addClass('text-success');
                    $("#confi2_v_"+id).val('0');
                }
                else if(confi2_v_=='0') {
                    $("#confi2_" + id).removeClass('text-grey-goto');
                    $("#confi2_" + id).removeClass('text-success');
                    $("#confi2_" + id).addClass('text-grey-goto');
                    $("#confi2_v_" + id).val('1');
                }
            }

        }).fail(function (data) {
        });

    })


}
function segunda_confirmada_hotel(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar los cambios?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        var confi2_v_=$("#confi2_v_h_"+id).val();
        console.log('hola:'+confi2_v_);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../../admin/operaciones/segunda-confirmada-hotel', 'confi2='+confi2_v_+'&id='+id, function(data) {
            $("#rpt_"+id).html(data);
            if(data=='1'){
                if(confi2_v_=='1'){
                    $("#confi2_h_"+id).removeClass('text-grey-goto');
                    $("#confi2_h_"+id).removeClass('text-success');
                    $("#confi2_h_"+id).addClass('text-success');
                    $("#confi2_v_h_"+id).val('0');
                }
                else if(confi2_v_=='0') {
                    $("#confi2_h_" + id).removeClass('text-grey-goto');
                    $("#confi2_h_" + id).removeClass('text-success');
                    $("#confi2_h_" + id).addClass('text-grey-goto');
                    $("#confi2_v_h_" + id).val('1');
                }
            }

        }).fail(function (data) {
        });
    })
}

// function guardar_imagen_pago(){
//     $('#guardar_imagen_pago').submit(function() {
//
//         // Enviamos el formulario usando AJAX
//         $.ajax({
//             type: 'POST',
//             url: $(this).attr('action'),
//             data: $(this).serialize(),
//             // Mostramos un mensaje con la respuesta de PHP
//             success: function(data) {
//                 if(data==1){
//                     $('#result_'+id).removeClass('text-danger');
//                     $('#result_'+id).addClass('text-success');
//                     $('#result_'+id).html('imagen guardada Correctamente!');
//                 }
//                 else{
//                     $('#result_'+id).removeClass('text-success');
//                     $('#result_'+id).addClass('text-danger');
//                     $('#result_'+id).html('Error al guardar la imagen, intentelo de nuevo');
//                 }
//             }
//         })
//         // esto es para que no se reenvie el formulario
//         return false;
//     });
// }

function eliminar_hotel_pro(hotel,id) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar los precios para el hotel "+hotel+"?",
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
        $.post('/admin/cost/hotel/proveedor/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#h_p_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}
function Enviar_codigo_reserva(id) {
    $('#add_cod_verif_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_'+id).removeClass('btn-primary');
                    $('#btn_'+id).addClass('btn-warning');
                    $('#btn_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Codigo guardado correctamente',
                        'success'
                    )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error al guardar el codigo',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function Enviar_codigo_reserva_hotel(id) {
    $('#add_cod_verif_hotel_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_h_'+id).removeClass('btn-primary');
                    $('#btn_h_'+id).addClass('btn-warning');
                    $('#btn_h_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Codigo guardada correctamente',
                        'success'
                    )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error al guardar el codigo',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function Enviar_hora_reserva(id) {
    $('#add_time_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_hora_'+id).removeClass('btn-primary');
                    $('#btn_hora_'+id).addClass('btn-warning');
                    $('#btn_hora_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Hora guardada correctamente',
                        'success'
                    )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error al guardar la hora',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function Enviar_hora_reserva_hotel(id) {
    $('#add_hora_hotel_path_'+id).submit(function() {

        // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#btn_hora_h_'+id).removeClass('btn-primary');
                    $('#btn_hora_h_'+id).addClass('btn-warning');
                    $('#btn_hora_h_'+id).html('<i class="fa fa-edit" aria-hidden="true"></i>');
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Hora guardado correctamente',
                        'success'
                    )
                }
                else{
                    swal(
                        'MENSAJE DEL SISTEMA',
                        'Error al guardar la hora',
                        'warning'
                    )
                }
            }
        })
        return false;
    });
}
function mostrar_barra_avance(){



    var $nro_servicios_reservados=$('#nro_servicios_reservados').val();
    var $nro_servicios_total=$('#nro_servicios_total').val();

    var $porc_avance=parseFloat(parseInt($nro_servicios_reservados)/parseInt($nro_servicios_total)).toFixed(2);
    var $porc_avance=$porc_avance*100;
    var $colo_progres='progress-bar-danger';
    if(25<$porc_avance&&$porc_avance<=50)
        $colo_progres='progress-bar-warning';

    if(50<$porc_avance&&$porc_avance<=75)
        $colo_progres='progress-bar-info';

    if(50<$porc_avance&&$porc_avance<=100)
        $colo_progres='progress-bar-success';

    $('#barra_porc').removeClass('progress-bar-danger');
    $('#barra_porc').removeClass('progress-bar-warning');
    $('#barra_porc').removeClass('progress-bar-info');
    $('#barra_porc').removeClass('progress-bar-success');

    console.log('nro_servicios_reservados:'+$nro_servicios_reservados+'-'+'nro_servicios_total:'+$nro_servicios_total);
    console.log('$colo_progres:'+$colo_progres+'-'+'porc_avance:'+$porc_avance);

    $('#barra_porc').addClass($colo_progres);
    $('#barra_porc').attr('aria-valuenow', $porc_avance).css('width',$porc_avance+'%');
    $('#barra_porc').html($porc_avance+'%');

}
var dato_producto_id=0;
function Guardar_proveedor(id) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
        // Enviamos el formulario usando AJAX
    var prove='';
        $.ajax({
            type: 'POST',
            url: $('#asignar_proveedor_path_'+id).attr('action'),
            data: $('#asignar_proveedor_path_'+id).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data==1){
                    $('#rpt_book_proveedor_'+id).html('Proveedor asignado correctamente!');
                    $('#book_precio_asig_'+id).html('$'+$('#book_price_'+dato_producto_id).val());
                    prove=$('#proveedor_servicio_'+dato_producto_id).val();
                    $('#boton_prove_'+id).html('<i class="fa fa-edit"></i>');
                    // $('#boton_prove_'+id).removeClass('btn-primary');
                    // $('#boton_prove_'+id).addClass('btn-warning');
                    $('#book_proveedor_'+id).html(prove);
                    $('#book_proveedor_'+id).fadeIn();
                    $('#estado_proveedor_serv_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');
                    $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
                    mostrar_barra_avance();
                }
                else{
                    $('#rpt_book_proveedor_'+id).removeClass('text-success');
                    $('#rpt_book_proveedor_'+id).addClass('text-danger');
                    $('#rpt_book_proveedor_'+id).html('Error al asignar al proveedor!');
                }
            }
        })
        return false;
    // });
}
function Guardar_proveedor_costo(id) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var justi=$('#txt_justificacion_'+id).val();
    if(justi.trim()==''){
        $('#rpt_book_proveedor_costo_'+id).html('Ingrese su justificacion');
        return false;
    }
    var prove='';
    $.ajax({
        type: 'POST',
        url: $('#asignar_proveedor_costo_path_'+id).attr('action'),
        data: $('#asignar_proveedor_costo_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                $('#rpt_book_proveedor_costo_'+id).html('Costo editado correctamente!');
                $('#book_precio_asig_'+id).html('$'+$('#book_price_edit_'+id).val());

                // prove=$('#proveedor_servicio_'+dato_producto_id).val();
                // $('#boton_prove_'+id).html('<i class="fa fa-edit"></i>');
                // // $('#boton_prove_'+id).removeClass('btn-primary');
                // // $('#boton_prove_'+id).addClass('btn-warning');
                // $('#book_proveedor_'+id).html(prove);
                // $('#book_proveedor_'+id).fadeIn();
                // $('#estado_proveedor_serv_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');
                // $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
                // mostrar_barra_avance();
            }
            else{
                $('#rpt_book_proveedor_'+id).removeClass('text-success');
                $('#rpt_book_proveedor_'+id).addClass('text-danger');
                $('#rpt_book_proveedor_'+id).html('Error al asignar al proveedor!');
            }
        }
    })
    return false;
    // });
}
function dato_producto(valor){
    dato_producto_id=valor;
    console.log('valor:'+valor);
}


var dato_producto_hotel_id=0;
function Guardar_proveedor_hotel(id) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var prove='';
    $.ajax({
        type: 'POST',
        url: $('#asignar_proveedor_hotel_path_'+id).attr('action'),
        data: $('#asignar_proveedor_hotel_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                $('#rpt_book_proveedor_hotel_'+id).html('Proveedor asignado correctamente!');
                $('#book_precio_asig_hotel_'+id).html($('#book_price_hotel_'+dato_producto_hotel_id).html()+' $');
                prove=$('#proveedor_servicio_hotel_'+dato_producto_hotel_id).html();
                $('#boton_prove_hotel_'+id).html('<i class="fa fa-edit"></i>');
                // $('#boton_prove_hotel_'+id).removeClass('btn-primary');
                // $('#boton_prove_hotel_'+id).addClass('btn-warning');
                $('#book_proveedor_hotel_'+id).html(prove);
                $('#book_proveedor_hotel_'+id).fadeIn();
                $('#estado_proveedor_serv_hotel_'+id).html('<i class="fa fa-check fa-2x text-success"></i>');

                $('#nro_servicios_reservados').val(parseInt($('#nro_servicios_reservados').val())+1);
                mostrar_barra_avance();
            }
            else{
                $('#rpt_book_proveedor_hotel_'+id).removeClass('text-success');
                $('#rpt_book_proveedor_hotel_'+id).addClass('text-danger');
                $('#rpt_book_proveedor_hotel_'+id).html('Error al asignar al proveedor!');
            }
        }
    })
    return false;
    // });
}

function dato_producto_hotel(valor){
    dato_producto_hotel_id=valor;
    console.log('valor:'+valor);
}

function guardar_reserva(){
    var nro_servicios_total=parseInt($('#nro_servicios_total').val());
    var nro_ser_reservado=parseInt($('#nro_servicios_reservados').val());
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar la reserva?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
// Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $('#form_guardar_reserva').attr('action'),
            data: $('#form_guardar_reserva').serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {

            }
        })
        swal(
            'Genial...',
            'Su reserva se acaba de enviar al area contable para gestionar los pagos!',
            'success'
        )
    })
}
function guardarPrecio(valor,id,fecha){
    console.log('valor:'+valor+',id:'+id+',fecha:'+fecha);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar este precio?",
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
        $.ajax({
            type: 'POST',
            url: '../../../contabilidad/servicios/guardar-total',
            data: 'id='+id+'&valor='+valor+'&fecha='+fecha,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    $('#btn_save_'+id).addClass('hide');
                    swal(
                        'Genial...',
                        'El precio se guardo correctamente!',
                        'success'
                    )
                    $('#btn_pagar_'+id).removeClass('hide');
                }

            }
        })
    })
}
function guardarPrecio_h(valor,id,fecha){
    console.log('valor:'+valor+',id:'+id+',fecha:'+fecha);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar este precio?",
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
        $.ajax({
            type: 'POST',
            url: '../../../contabilidad/hotels/guardar-total',
            data: 'id='+id+'&valor='+valor+'&fecha='+fecha,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    $('#btn_save_h_'+id).addClass('hide');
                    swal(
                        'Genial...',
                        'El precio se guardo correctamente!',
                        'success'
                    )
                    $('#btn_pagar_h_'+id).removeClass('hide');
                }

            }
        })
    })
}

function pagar_entrada(id,valor){
    if(valor=='' ||valor==0 ){
        swal(
            'Ups...',
            'No se reservo este servicio!',
            'warning'
        )
        return false;
    }
    console.log('valor:'+valor+',id:'+id);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de realizar el pago?",
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
        $.ajax({
            type: 'POST',
            url: '../../../../../../../../contabilidad/entradas/pagar',
        data: 'id='+id+'&valor='+valor,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
            console.log('data:'+data);
            if(data==1) {
                $('#btn_pagar_'+id).addClass('hide');
                $('#btn_revertir_'+id).removeClass('hide');
                swal(
                    'Genial...',
                    'El pago se guardo correctamente!',
                    'success'
                )
                $('#check_'+id).removeClass('hide');

                $('#fecha_'+id).removeClass('bg-danger');
                $('#fecha_'+id).addClass('bg-success');

                $('#clase_'+id).removeClass('bg-danger');
                $('#clase_'+id).addClass('bg-success');

                $('#servicio_'+id).removeClass('bg-danger');
                $('#servicio_'+id).addClass('bg-success');

                $('#ad_'+id).removeClass('bg-danger');
                $('#ad_'+id).addClass('bg-success');

                $('#pax_'+id).removeClass('bg-danger');
                $('#pax_'+id).addClass('bg-success');

                $('#ads_'+id).removeClass('bg-danger');
                $('#ads_'+id).addClass('bg-success');

                $('#total_'+id).removeClass('bg-danger');
                $('#total_'+id).addClass('bg-success');

                $('#categoria_'+id).removeClass('bg-danger');
                $('#categoria_'+id).addClass('bg-success');

                $('#estado_'+id).removeClass('bg-danger');
                $('#estado_'+id).addClass('bg-success');
            }

        }
    })
    })
}
function pagar_entrada_pagos(id,valor){
    if(valor=='' ||valor==0 ){
        swal(
            'Ups...',
            'No se reservo este servicio!',
            'warning'
        )
        return false;
    }
    console.log('valor:'+valor+',id:'+id);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de realizar el pago?",
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
        $.ajax({
            type: 'POST',
            url: '../../contabilidad/entradas/pagar',
            data: 'id='+id+'&valor='+valor,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    var cvalor=parseFloat(valor);
                    $('#btn_pagar_ticket_'+id).addClass('hide');
                    $('#a_cuenta_r_'+id).html('$'+cvalor);
                    $('#saldo_r_'+id).html('$0');
                    var total_a_cuenta = parseFloat($('#total_a_cuenta').html());
                    var total_saldo = parseFloat($('#total_saldo').html());
                    total_a_cuenta+=cvalor;
                    total_saldo+=cvalor;
                    $('#total_a_cuenta').html(total_a_cuenta);
                    $('#total_saldo').html(total_saldo);
                    swal(
                        'Genial...',
                        'El pago se guardo correctamente!',
                        'success'
                    )
                    $('#check_'+id).removeClass('hide');
                }

            }
        })
    })
}

function Pasar_pro(id,grupo,idservicio){
    // $('#lista_costos_'+id).append('iti_temp');
    var pro='proveedores_'+idservicio;
    $("input[class="+pro+"]").each(function (index) {
        if ($(this).is(':checked')) {
            var proveedor = $(this).val().split('_');
            console.log('proveedor:'+proveedor[1]);
            if (!existe_proveedor(proveedor[1],id)) {
                var iti_temp1='';
                console.log('no existe este proveedor');
                iti_temp1='<div id="fila_'+grupo+'_'+id+'_'+idservicio+'_'+proveedor[0]+'" class="row">'+
                            '<div class="col-lg-8 fila_proveedores_'+id+'">'+proveedor[1]+'</div>'+
                            '<div class="col-lg-2">'+
                                '<input type="hidden" name="pro_id[]" value="'+proveedor[0]+'"></td>'+
                                '<input type="number" name="pro_val[]" class="form-control" style="width: 80px" value="0.00" min="0" step="0.01"></td>'+
                            '</div>'+
                            '<div class="col-lg-2">'+
                                '<button type="button" class="btn btn-danger" onclick="eliminar_proveedor('+id+','+grupo+','+idservicio+','+proveedor[0]+',\''+proveedor[1]+'\')">'+
                                    '<i class="fa fa-trash-o" aria-hidden="true"></i>'+
                                '</button>'+
                            '</div>'+
                          '</div>';
                $('#lista_costos_'+grupo+'_'+id+'_'+idservicio).append(iti_temp1);
                console.log('algo paso por aqui');
            }
            $(this).prop("checked","");
        }
    });
}

function eliminar_proveedor(id1,grupo,idservicio,id,nombre) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar a "+nombre+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $('#fila_'+grupo+'_'+id1+'_'+idservicio+'_'+id).fadeOut( "slow");
    })
}
function eliminar_proveedor_comprobando(id,costo_id,proveedor_id,nombre) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar a "+nombre+"?",
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
        $.ajax({
            type: 'POST',
            url: '../admin/ventas/service/eliminar-proveedor',
            data: 'costo_id='+costo_id+'&proveedor_id='+proveedor_id,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                if(data=='1'){
                    $('#fila_p_'+id+'_'+costo_id+'_'+proveedor_id).fadeOut("slow");
                    $('#fila_p_'+id+'_'+costo_id+'_'+proveedor_id).remove();

                    // se elimino con exito
                }
                else if(data=='2'){
                    // este costo se esta usado en una cotizacion
                    $('#result_'+id).html('Este proveedor esta siendo usado en una cotizacion');
                }
                console.log(data);

            }
        })

        // $("#fila_"+id).fadeOut( "slow");
    })
}
function existe_proveedor(clave,id){
    var existe=false;
    var fila='.fila_proveedores_'+id;
    console.log('preparandonos  para buscar');
    $(fila).each(function (index1) {
        console.log('recorremos->'+'clave:'+clave+'==$(this).html():'+$(this).html());
        if(clave==$(this).html()){
            existe=true;
        }
    });
    return existe;
}

function nuevos_proveedores(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../admin/ventas/service/listar-proveedores',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&categoria='+categoria,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            console.log(data);
            $('#lista_proveedores_'+pos+'_'+categoria).html(data);
        }
    })
}
function guardarPrecio_Ticket(valor,id,fecha,pax){
    console.log('valor:'+valor+',id:'+id+',fecha:'+fecha);
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de guardar este precio?",
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
        $.ajax({
            type: 'POST',
            url: '../../../contabilidad/servicios/guardar-total/ticket',
            data: 'id='+id+'&valor='+valor+'&fecha='+fecha+'&pax='+pax,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    $('#btn_save_ticket_'+id).addClass('hide');
                    swal(
                        'Genial...',
                        'El precio se guardo correctamente!',
                        'success'
                    )
                    $('#btn_pagar_ticket_'+id).removeClass('hide');
                }

            }
        })
    })
}
function Enviar_precio_c(id,precio_c) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-precio-c', 'id='+id+'&precio_c='+precio_c, function (data) {
    if(data==1) {
        $('#btn_'+id).removeClass('btn-primary')
        $('#btn_'+id).addClass('btn-warning')
        swal(
            'MENSAJE DEL SISTEMA',
            'Costo confirmado',
            'success'
        )
    }
    else{
        swal(
            'MENSAJE DEL SISTEMA',
            'Error al confirmar el costo, intente de nuevo',
            'warning'
        )
    }
    }).fail(function (data) {
    });
}
function Enviar_precio_c_h(n_u,tipo,id,precio_c,paquete_cotizaciones_id){
    console.log('n_u:'+n_u+',tipo:'+tipo+',id:'+id+',precio_c:'+precio_c);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-precio-c-hotel', 'n_u='+n_u+'&tipo='+tipo+'&id='+id+'&precio_c='+precio_c+'&paquete_cotizaciones_id='+paquete_cotizaciones_id, function (data) {
        if(data==1) {
            $('#btn_h_'+tipo+'_'+id).removeClass('btn-primary')
            $('#btn_h_'+tipo+'_'+id).addClass('btn-warning')
            swal(
                'MENSAJE DEL SISTEMA',
                'Costo confirmado',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al confirmar el costo, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}

function buscar_hoteles_pagos_pendientes(ini,fin){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/pagos/pendientes/filtrar', 'ini='+ini+'&fin='+fin, function (data) {
            $('#rpt_hotel').html(data);

    }).fail(function (data) {
    });
}
function eliminar_servicio_reservas(id,servicio) {
    // alert('holaaa');
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar "+servicio+" ?",
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
        $.post('/admin/book/servicio/delete', 'id='+id, function(data){
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#servicio_"+id).fadeOut( "low");
                swal(
                    'Mensaje del sistema',
                    'Se borro els ervicio '+categoria,
                    'success'
                )
            }
        }).fail(function (data) {

        });

    })
}
function Guardar_observacion_hoja(id) {
    // $('#asignar_proveedor_path_'+id).submit(function() {
    // Enviamos el formulario usando AJAX
    var obs=$('#txt_observacion_hoja_ruta_'+id).val();
    if(obs.trim()==''){
        $('#rpt_book_hoja_costo_'+id).html('Ingrese su observacion');
        return false;
    }
    var prove='';
    $.ajax({
        type: 'POST',
        url: $('#ingresar_observaciones_hoja_path_'+id).attr('action'),
        data: $('#ingresar_observaciones_hoja_path_'+id).serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                $('#rpt_book_hoja_costo_'+id).html('Observacion guardada correctamente!');
                $('#obs_'+id).html(obs);
            }
            else{
                $('#rpt_book_hoja_costo_'+id).removeClass('text-success');
                $('#rpt_book_hoja_costo_'+id).addClass('text-danger');
                $('#rpt_book_hoja_costo_'+id).html('Error al guardar las observaciones !');
            }
        }
    })
    return false;
    // });
}
function confirma_envio_servicio_reservas(id,estado1) {
    // alert('holaaa');
    var estado=$("#estado_send_"+id).val();
    var msj="¿Estas seguro que quiere confirmar el envio?";
    if(estado==0)
        msj="¿Estas seguro que quiere revertir el envio?";
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: msj,
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
        $.post('/admin/book/servicio/envio', 'id='+id+'&estado='+estado, function(data){
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#servicio_"+id).fadeOut( "low");
                if(estado==1){
                    // pintamos de verde
                    $("#estado_send_"+id).val('0');
                    $("#confirm_send_"+id).removeClass('btn-unset');
                    $("#confirm_send_"+id).addClass('btn-success');
                }
                else if(estado==0){
                    // pintamos de unset
                    $("#estado_send_"+id).val('1');
                    $("#confirm_send_"+id).removeClass('btn-success');
                    $("#confirm_send_"+id).addClass('btn-unset');
                }
                swal(
                    'Mensaje del sistema',
                    'Se realiazo la operacion con exito',
                    'success'
                )
            }
        }).fail(function (data) {

        });

    })
}
function verificar_reservados(no_rservados){

    $('#form_nuevo_pqt').submit(function(){


    });
}
function verificar_reservados(no_rservados){

        if (no_rservados > 0) {

            swal(
                'Mensaje del sistema',
                'Ups!. Hay ' + no_rservados + ' entradas no reservadas, reservas debe de realizar esta opracion para que se pueda pagar',
                'warning'
            )
            return false;
        }
        // swal({
        //     title: 'MENSAJE DEL SISTEMA',
        //     text: "¿Estas seguro de pagar todas las entradas?",
        //     type: 'question',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes'
        // }).then(function () {
        //     $('#form_pagar_entradas_full').submit(function() {});
        // })

}
function revertir_pago_entrada(id,valor){
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de revertir el pago?",
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
        $.ajax({
            type: 'POST',
            url: '../../../../../../../../contabilidad/entradas/revertir',
            data: 'id='+id+'&valor='+valor,
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                console.log('data:'+data);
                if(data==1) {
                    $('#btn_pagar_'+id).removeClass('hide');
                    $('#btn_revertir_'+id).addClass('hide');

                    swal(
                        'Genial...',
                        'El pago se revirtio correctamente!',
                        'success'
                    )
                    $('#check_'+id).addClass('hide');

                    $('#fecha_'+id).removeClass('bg-success');
                    $('#fecha_'+id).addClass('bg-danger');

                    $('#clase_'+id).removeClass('bg-success');
                    $('#clase_'+id).addClass('bg-danger');

                    $('#servicio_'+id).removeClass('bg-success');
                    $('#servicio_'+id).addClass('bg-danger');

                    $('#ad_'+id).removeClass('bg-success');
                    $('#ad_'+id).addClass('bg-danger');

                    $('#pax_'+id).removeClass('bg-success');
                    $('#pax_'+id).addClass('bg-danger');

                    $('#ads_'+id).removeClass('bg-success');
                    $('#ads_'+id).addClass('bg-danger');

                    $('#total_'+id).removeClass('bg-success');
                    $('#total_'+id).addClass('bg-danger');

                    $('#categoria_'+id).removeClass('bg-success');
                    $('#categoria_'+id).addClass('bg-danger');

                    $('#estado_'+id).removeClass('bg-success');
                    $('#estado_'+id).addClass('bg-danger');
                }

            }
        })
    })
}

function guardar_cta(){
    var id=$('#id').val();
    var nro_cheque=$('#nro_cheque_s').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/contabilidad/entradas/codigo',
        data: 'id='+id+'&nro_cheque='+nro_cheque+'&tipo=s',
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                console.log('se guardo');
                swal(
                    'Genial...',
                    'El nro de operacion se guardo correctamente!',
                    'success'
                )
            }

        }
    })
}
function guardar_cta_c() {
    var id=$('#id').val();
    var nro_cheque=$('#nro_cheque_c').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/contabilidad/entradas/codigo',
        data: 'id='+id+'&nro_cheque='+nro_cheque+'&tipo=c',
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            if(data==1){
                console.log('se guardo');
                swal(
                    'Genial...',
                    'El nro de operacion se guardo correctamente!',
                    'success'
                )
            }

        }
    })
    // var id=$('#id').val();
    // var nro_cheque_c=$('#nro_cheque_c').val();
    //
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('[name="_token"]').val()
    //     }
    // });
    // $.post('/admin/contabilidad/entradas/codigo', 'id='+id+'&nro_cheque_c='+nro_cheque_c+'&tipo=c', function(data) {
    //     if(data==1){
    //         swal(
    //             'Mensaje del sistema',
    //             'Se guardo el nro correctamente,
    //         'success'
    //     )
    //     }
    // }).fail(function (data) {
    //
    // });
}

function eliminar_liquidacion(id,ini,fin) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar la liquidacion (Desde:"+ini+" - Hasta:"+fin+"?",
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
        $.post('/admin/contabilidad/operaciones/pagos-pendientes/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_liquidaciones_"+id).fadeOut( "slow");
            }
        }).fail(function (data) {

        });

    })
}

function llamar_servicios(destino,grupo){
    console.log('destino:'+destino+',grupo:'+grupo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/ventas/call/servicios/grupo', 'destino='+destino+'&grupo='+grupo, function(data) {
        $("#list_servicios_grupo").html(data);

    }).fail(function (data) {

    });
}
var total_serv=0;
function escojer_servicio(){
    total_serv=$('#nroServicios').val();
    var destino_escoj=$('#destinos_escoj').html();
    var destino_escoj_titulo=$('#destinos_escoj_titulo').html();
    var itinerario='';
    var iti_temp='';
    $("input[class='servicios1']").each(function (index){
        if($(this).is(':checked')){
            itinerario='';
            itinerario=$(this).val().split('_');
            var $grupo=itinerario[5];
            if(!existe_servicio(itinerario[2]))
            {
                total_serv++;
                iti_temp = '<div id="elto_'+itinerario[2]+'" class="col-lg-11 elemento_sort">'+
                    '<div class="row">'+
                '<div class="col-lg-1 text-11 puntero"><span class="text-unset"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span></div>'+
                '<div class="col-lg-1 pos text-10">'+total_serv+'</div>'+
                '<div class="col-lg-9 text-12">';
                if($grupo=='TOURS')
                    iti_temp +='<i class="fa fa-map-o text-info" aria-hidden="true"></i>';
                else if($grupo == 'MOVILID'){
                    var $clase=itinerario[6];
                    if ($clase == 'BOLETO')
                        iti_temp +='<i class= "fa fa-ticket text-warning" aria-hidden="true"></i>';
                    else
                        iti_temp += '<i class= "fa fa-bus text-warning" aria-hidden="true"></i>';

                }
                else if($grupo == 'REPRESENT')
                    iti_temp += '<i class = "fa fa-users text-success" aria-hidden="true"></i>';
                else if($grupo == 'ENTRANCES')
                    iti_temp += '<i class= "fa fa-ticket text-success" aria-hidden="true"></i>';
                else if($grupo == 'FOOD')
                    iti_temp += '<i class = "fa fa-cutlery text-danger" aria-hidden="true"></i>';
                else if($grupo == 'TRAINS')
                    iti_temp += '<i class = "fa fa-train text-info" aria-hidden="true"></i>';
                else if($grupo == 'FLIGHTS')
                    iti_temp += '<i class = "fa fa-plane text-primary" aria-hidden="true"></i>';
                else if($grupo == 'OTHERS')
                    iti_temp += '<i class = "fa fa-question text-success" aria-hidden="true"></i>';

                iti_temp += itinerario[4]+'<span class="text-warning"> ('+destino_escoj_titulo+')</span><input type="hidden" name="servicios_esc[]" value="'+itinerario[2]+'"><input type="hidden" name="destinos_esc[]" value="'+destino_escoj+'"></div>'+
            '<div class="col-lg-1 text-13 puntero"><span class="text-danger" onclick="borrar_servicios_esc(\''+itinerario[2]+'\',\''+itinerario[4]+'\')"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div>'+
                '</div>'+
                '</div>';

                $('#caja_1').append(iti_temp);
            }
            $(this).prop("checked", "");
        }
    });
    $('#nroServicios').val(total_serv);

    if(!existe_destino('#txt_destino_foco option',destino_escoj)) {
        var destino_foco = '<option value="' + destino_escoj + '">' + destino_escoj_titulo + '</option>';
        $('#txt_destino_foco').append(destino_foco);
    }
    if(!existe_destino('#txt_destino_duerme option',destino_escoj)) {
        var destino_duerme = '<option value="' + destino_escoj + '">' + destino_escoj_titulo + '</option>';
        $('#txt_destino_duerme').append(destino_duerme);
    }
}
function existe_destino(cb,clave){
    var existe=false;
    $(cb).each(function(){
        if($(this).attr('value')==clave)
            existe=true;
            // alert('opcion '+$(this).text()+' valor '+ $(this).attr('value'))
    });
    return existe;
}
function existe_servicio(clave){
    var existe=false;
    $(".elemento_sort").each(function (index1) {
        var valor_servicio1=$(this).attr('id');
        var valor_servicio=valor_servicio1.split('_');
        if(clave==valor_servicio[1]){
            existe=true;
        }
    });
    return existe;
}

function borrar_servicios_esc(id,titulo) {
    swal({
        title: 'MENSAJE DEL SISTEMA',
        text: "¿Estas seguro de eliminar el servicio "+titulo+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function () {
        $("#elto_"+id).fadeOut("slow");
        $("#elto_"+id).remove();
        ordenar_servicios();
        total_serv=parseInt($('#nroServicios').val());
        total_serv--;
        $('#nroServicios').val(total_serv);
    })
}
function ordenar_servicios() {
    var titles =$('.caja_sort').children('.elemento_sort').children('.row').children('.pos');
    $(titles).each(function(index, element){
        var elto=$(element).html();
        var pos=(index+1);
        $(element).html(pos);
    });
}

function mostrar_hoteles_categoria(pos) {
    var cate = $('#txt_categoria_' + pos).val();
    for(var i=2;i<=5;i++) {
        $("#header_"+i).addClass("hide");
        $("#dato_s_"+i).addClass("hide");
        $("#dato_d_"+i).addClass("hide");
        $("#dato_m_"+i).addClass("hide");
        $("#dato_t_"+i).addClass("hide");
        $("#dato_ss_"+i).addClass("hide");
        $("#dato_sd_"+i).addClass("hide");
        $("#dato_su_"+i).addClass("hide");
        $("#dato_js_"+i).addClass("hide");
    }
    $("#header_"+cate).removeClass("hide");
    $("#dato_s_"+cate).removeClass("hide");
    $("#dato_d_"+cate).removeClass("hide");
    $("#dato_m_"+cate).removeClass("hide");
    $("#dato_t_"+cate).removeClass("hide");
    $("#dato_ss_"+cate).removeClass("hide");
    $("#dato_sd_"+cate).removeClass("hide");
    $("#dato_su_"+cate).removeClass("hide");
    $("#dato_js_"+cate).removeClass("hide");
}
function limpiar_caja_servicios() {
    $("#list_servicios_grupo").html('');
}

function mostrar_proveedores(destino,grupo){
    console.log('destino:'+destino+',grupo:'+grupo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/provider/filtro/localizacion', 'destino='+destino+'&grupo='+grupo, function(data) {
        $("#caja_listado_proveedores_"+grupo).html(data);

    }).fail(function (data) {

    });
}
function mostrar_proveedores_x_estrellas(destino,grupo,estrellas){
    console.log('destino:'+destino+',grupo:'+grupo);
    if(destino=='0_ninguno'){
        swal(
            'MENSAJE DEL SISTEMA',
            'Escoja la localizacion.',
            'warning'
        )
        return false;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/provider/filtro/localizacion/estrellas', 'destino='+destino+'&grupo='+grupo+'&estrellas='+estrellas, function(data) {
        $("#caja_listado_proveedores_"+grupo).html(data);

    }).fail(function (data) {

    });
}

function mostrar_proveedores_cost(destino,grupo){
    console.log('destino:'+destino+',grupo:'+grupo);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/cost-provider/filtro/localizacion', 'destino='+destino+'&grupo='+grupo, function(data) {
        $("#caja_listado_cost_proveedores_"+grupo).html(data);

    }).fail(function (data) {

    });
}
function mostrar_proveedores_x_estrellas_cost(destino,grupo,estrellas){
    console.log('destino:'+destino+',grupo:'+grupo);
    if(destino=='0_ninguno'){
        swal(
            'MENSAJE DEL SISTEMA',
            'Escoja la localizacion.',
            'warning'
        )
        return false;
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/cost-provider/filtro/localizacion/estrellas', 'destino='+destino+'&grupo='+grupo+'&estrellas='+estrellas, function(data) {
        $("#caja_listado_cost_proveedores_"+grupo).html(data);

    }).fail(function (data) {

    });
}

function mostrar_class(proveedor_id,array_pro,grupo,id,idservicio) {
    var array_prove_train = array_pro.split('_');
    var proveedor = proveedor_id.split('_');
    var pos=6;
    if (proveedor_id!='0'){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.post('../../../admin/productos/lista/empresa/mostrar-clases','proveedor_id='+proveedor_id+'&pos='+pos, function(data) {
            $("#mostrar_clase").html(data);
        }).fail(function (data) {
        });
        // $.each(array_prove_train, function (key, value) {
        //     $("#proveedor_" + value).addClass('hide');
        //     $("#proveedor_" + value).fadeOut("slow");
        // });
        // $("#proveedor_" + proveedor[0]).removeClass('hide');
        // $("#proveedor_" + proveedor[0]).fadeIn("slow");
        // $("#fila_"+proveedor_id).removeClass('hide');
        // $("#fila_"+proveedor_id).fadeIn("slow");
        var iti_temp1 = '';
        iti_temp1 = '<div id="fila_' + grupo + '_' + id + '_' + idservicio + '_' + proveedor[0] + '" class="row">' +
            '<div class="col-lg-8 fila_proveedores_' + id + '">' + proveedor[1] + '</div>' +
            '<div class="col-lg-2">' +
            '<input type="hidden" name="pro_id[]" value="' + proveedor[0] + '"></td>' +
            '<input type="number" name="pro_val[]" class="form-control" style="width: 80px" value="0.00" min="0" step="0.01"></td>' +
            '</div>' +
            // '<div class="col-lg-2">'+
            // '<button type="button" class="btn btn-danger" onclick="eliminar_proveedor('+id+','+grupo+','+idservicio+','+proveedor_id]+',\''+proveedor+'\')">'+
            // '<i class="fa fa-trash-o" aria-hidden="true"></i>'+
            // '</button>'+
            // '</div>'+
            '</div>';
        $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).html(iti_temp1);
    }
    else {
        $('#lista_costos_' + grupo + '_' + id + '_' + idservicio).html('');
    }
}
function eliminar_hotel_provider(id,servicio) {
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
        $.post('/admin/hotel-provider/delete', 'id='+id, function(data) {
            if(data==1){
                // $("#lista_destinos_"+id).remove();
                $("#lista_provider_"+id).fadeOut( "slow");
            }
            else if(data==2){
                swal(
                    'Porque no puedo borar?',
                    'El proveedor se esta usando en alguna cotizacion, no es posible borrar este proveedor.',
                    'warning'
                )
            }
        }).fail(function (data) {
        });
    })
}
function actualizar_fecha(servicio_id,fecha,proveedor_id,pqt_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-fecha', 'id='+servicio_id+'&fecha='+fecha+'&proveedor_id='+proveedor_id+'&pqt_id='+pqt_id, function (data) {
        if(data==1) {
            $('#btn_fecha_'+servicio_id).removeClass('btn-primary')
            $('#btn_fecha'+servicio_id).addClass('btn-warning')
            swal(
                'MENSAJE DEL SISTEMA',
                'Fecha confirmada',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al confirmar la fecha, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}
function actualizar_titulo(itinerario_id,iti_nuevo_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/actualizar-titulo', 'itinerario_id='+itinerario_id+'&iti_nuevo_id='+iti_nuevo_id, function (data) {
        var dat=data.split('_');
        if(dat[0]==1){
            $('#titulo_'+itinerario_id).html(dat[1]);
            swal(
                'MENSAJE DEL SISTEMA',
                'titulo actualizado',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al actualizar el titulo, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}

function actualizar_fecha_h(servicio_id,fecha,proveedor_id,pqt_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/confirmar-fecha-hotel', 'id='+servicio_id+'&fecha='+fecha+'&proveedor_id='+proveedor_id+'&pqt_id='+pqt_id, function (data) {
        if(data==1) {
            $('#btn_fecha_h_'+servicio_id).removeClass('btn-primary')
            $('#btn_fecha_h_'+servicio_id).addClass('btn-warning')
            swal(
                'MENSAJE DEL SISTEMA',
                'Fecha confirmada',
                'success'
            )
        }
        else{
            swal(
                'MENSAJE DEL SISTEMA',
                'Error al confirmar la fecha, intente de nuevo',
                'warning'
            )
        }
    }).fail(function (data) {
    });
}
function buscar_servicios_pagos_pendientes(ini,fin,servicio){
    console.log('ini:'+ini+' - fin:'+fin+' - servicio:'+servicio);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/contabilidad/pagos/servicios/pendientes/filtrar', 'ini='+ini+'&fin='+fin+'&grupo='+servicio, function (data) {
        $('#rpt_'+servicio).html(data);

    }).fail(function (data) {
    });
}
function mostrar_tabla_empresa(grupo,id,empresa_id){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista/empresa','id='+id+'&empresa_id='+empresa_id, function(data) {
        $("#tb_datos_"+grupo).html(data);

    }).fail(function (data) {
    });
}
function nuevos_proveedores_movilidad_ruta(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../../ventas/service/listar-proveedores',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&categoria='+categoria,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            console.log(data);
            $('#lista_proveedores_'+categoria).html(data);
        }
    })
    $.ajax({
        type: 'POST',
        url: '../../ventas/service/listar-movilidad/',
        data: 'punto_inicio='+localizacion+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#rutas_'+pos).html(data);
        }
    })
}
function mostrar_tabla_destino_ruta(grupo,id,pos){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista', 'destino='+destino+'&id='+id, function(data) {
        $("#tb_datos_"+grupo).html(data);

    }).fail(function (data) {
    });
    $.post('../../admin/productos/lista/rutas', 'destino='+destino+'&id='+id+'&grupo='+grupo+'&pos='+pos, function(data) {
        $("#mostra_rutas_movilid").html(data);
    }).fail(function (data) {
    });
}
function mostrar_tabla_destino_ruta_datos(grupo,id,ruta,pos){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista/por-ruta', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos, function(data) {
        $("#tb_datos_"+grupo).html(data);
    }).fail(function (data) {
    });
    $.post('../../admin/productos/lista/por-ruta/cargar-tipos', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&pos='+pos+'&grupo='+grupo, function(data) {
        $("#mostra_tipo_"+grupo).html(data);
    }).fail(function (data) {
    });
}
function mostrar_tabla_destino_ruta_tipo_datos(grupo,id,ruta,tipo,pos){
    var  destino=$("#Destinos_"+grupo).val();
    console.log('mostrar_tabla_destino:'+destino);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('../../admin/productos/lista/por-ruta/tipo', 'destino='+destino+'&id='+id+'&ruta='+ruta+'&tipo='+tipo+'&pos='+pos, function(data) {
        $("#tb_datos_"+grupo).html(data);
    }).fail(function (data) {
    });
}
function nuevos_proveedores_movilidad_ruta_edit(pos,categoria,grupo) {
    var localizacion=$('#txt_localizacion_'+pos).val();
    console.log('localizacion:'+localizacion+'_grupo:'+grupo);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.ajax({
        type: 'POST',
        url: '../admin/ventas/service/listar-proveedores',
        data: 'localizacion='+localizacion+'&grupo='+grupo+'&categoria='+categoria,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            console.log(data);
            $('#lista_proveedores_'+pos+'_'+categoria).html(data);
        }
    })
    $.ajax({
        type: 'POST',
        url: '../admin/ventas/service/listar-movilidad/',
        data: 'punto_inicio='+localizacion+'&pos='+pos,
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#rutas_'+pos).html(data);
        }
    })
}