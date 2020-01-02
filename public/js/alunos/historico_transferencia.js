//Cuida do botão criar históricos
$(document).ready(function () {
    $('#turma').change(function () {
        var textoOptionSelecionado = $('#Ano').val(); // armazendando em variavel
        var textoOptionSelecionado2 = $('#turma').val(); // armazendando em variavel
        var texto3 = $('#curso').val(); // armazendando em variavel
        //       
        if (textoOptionSelecionado2 !== "Escolha uma Turma Formal" && textoOptionSelecionado !== "Selecione o Ano" && texto3 !== "Curso") {
            $('#criar_historico').removeAttr('disabled');
        } else {
            // alert("O Campo Ano e Turma Formal não Devem serem Enviados em Branco!");
            $('#criar_historico').attr('disabled', 'disabled');
        }

    });
    $('#Ano').change(function () {
        var textoOptionSelecionado = $('#Ano').val(); // armazendando em variavel
        var textoOptionSelecionado2 = $('#turma').val(); // armazendando em variavel
        var texto3 = $('#curso').val(); // armazendando em variavel
        //       
        if (textoOptionSelecionado2 !== "Escolha uma Turma Formal" && textoOptionSelecionado !== "Selecione o Ano" && texto3 !== "Curso") {
            $('#criar_historico').removeAttr('disabled');
        } else {
            // alert("O Campo Ano e Turma Formal não Devem serem Enviados em Branco!");
            $('#criar_historico').attr('disabled', 'disabled');
        }

    });
    $('#curso').change(function () {
        var texto = $('#Ano').val(); // armazendando em variavel
        var texto2 = $('#turma').val(); // armazendando em variavel
        var texto3 = $('#curso').val(); // armazendando em variavel
        //       
        if (texto2 !== "Escolha uma Turma Formal" && texto !== "Selecione o Ano" && texto3 !== "Curso") {
            $('#criar_historico').removeAttr('disabled');
        } else {
            alert("O Campo Ano,Turma Formal e Curso não Devem serem Enviados em Branco!");
            $('#criar_historico').attr('disabled', 'disabled');
        }
    });
    //Valida o botão Pesquisar Histórico
    $('input[type="checkbox"][name="CODIGO"]').on('change', function () {
        var total = $('input[type="checkbox"][name="CODIGO"]:checked').length;
        if (total > 0 && total < 2) {
            $('#pesquisar').removeAttr('disabled');
        } else {
            $('#pesquisar').attr('disabled', 'disabled');
        }
    });
    //Valida o botão excluir Histórico
    $('input[type="checkbox"][name="CODIGO"]').on('change', function () {
        var total = $('input[type="checkbox"][name="CODIGO"]:checked').length;
        if (total > 0 && total < 2) {
            $('#excluir').removeAttr('disabled');
        } else {
            $('#excluir').attr('disabled', 'disabled');
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
//Confirmar se pode excluir
function excluir() {
    var u = $('#usuario').val();
    var r = confirm("Já Posso Excluir " + u + "? ");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}
//Confirmar se pode pesquisar
function gerar() {
    var u = $('#usuario').val();
    var r = confirm("Já Posso Gerar o Histórico " + u + "? ");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

