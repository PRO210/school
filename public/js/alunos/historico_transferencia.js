//Cuida do botão criar históricos
$(document).ready(function () {
    $('#turma').change(function () {
        var textoOptionSelecionado = $('#Ano').val(); // armazendando em variavel
        var textoOptionSelecionado2 = $('#turma').val(); // armazendando em variavel
        //       
        if (textoOptionSelecionado2 !== "Escolha uma Turma Formal" && textoOptionSelecionado !== "Selecione o Ano") {           
            $('#criar_historico').removeAttr('disabled');
        } else {
            alert("O Campo Ano e Turma Formal não Devem serem Enviados em Branco!");
            $('#criar_historico').attr('disabled', 'disabled');
        }      

    });
    $('#Ano').change(function () {
        var textoOptionSelecionado = $('#Ano').val(); // armazendando em variavel
        var textoOptionSelecionado2 = $('#turma').val(); // armazendando em variavel
        //       
        if (textoOptionSelecionado2 !== "Escolha uma Turma Formal" && textoOptionSelecionado !== "Selecione o Ano") {           
            $('#criar_historico').removeAttr('disabled');
        } else {
            //alert("O Campo Ano e Turma Formal não Devem serem Enviados em Branco!");
            $('#criar_historico').attr('disabled', 'disabled');
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
