//Cuida do botão criar históricos
$(document).ready(function () {
    $('#Ano').change(function () {
        var textoOptionSelecionado = $('#Ano').val(); // armazendando em variavel
        if (textoOptionSelecionado == "Selecione o Ano") {
            alert("O Campo Ano não Deve ser Enviado em Branco!");
            $('#criar_historico').attr('disabled', 'disabled');
        } else {
            $('#criar_historico').removeAttr('disabled');
        }
    });

});
//Inibe as aspas simles e duplas
$('input').on("input", function (e) {
    $(this).val($(this).val().replace('"', ""));
    $(this).val($(this).val().replace("'", ""));

});
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
function maiuscula(z) {
    v = z.value.toUpperCase();
    z.value = v;
}
