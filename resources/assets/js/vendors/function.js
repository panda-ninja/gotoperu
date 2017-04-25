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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $.post('/admin/mostrar_itinerario', 'destinos='+destinos, function(data) {
        $("#lista_itinerarios").html(data);

    }).fail(function (data) {
        console.log('error: '+data);
    });
}
