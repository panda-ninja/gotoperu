/**
 * Created by Sigma on 12/04/2017.
 */
//sortable itinerary
$(function () {
    $(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'well placeholder',
        forceHelperSize: true
    });
});