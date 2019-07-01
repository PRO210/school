$(document).ready(function () {
    if ($('#transporte').val() == 'SIM') {
        $('#motorista').show();
    } else {
        $('#motorista').hide();
    }
    $('#transporte').change(function () {
        if ($('#transporte').val() == 'SIM') {
            $('#motorista').show();
        } else {
            $('#motorista').hide();
        }
    });
});
$('input').on("input", function (e) {
    $(this).val($(this).val().replace('"', ""));
    $(this).val($(this).val().replace("'", ""));

});
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
function maiuscula(z) {
    v = z.value.toUpperCase();
    z.value = v;
}
//Confirmar se pode salvar
function confirmar() {
    var u = $('#usuario').val();
    var r = confirm("Já Posso Enviar " + u + "? ");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}
