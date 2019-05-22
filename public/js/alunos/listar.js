//Marcar ou Desmarcar todos os checkbox
$(document).ready(function () {

    $('.selecionar').click(function () {
        if (this.checked) {
            $('.checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkbox').each(function () {
                this.checked = false;
            });
        }
    });

});


$('input[type=checkbox]').on('change', function () {
    var total = $('input[type=checkbox]:checked').length;
    if (total > 0) {
        //alert(total);
        $('#btEditBloc').removeAttr('disabled');

    } else {
        $('#btEditBloc').attr('disabled', 'disabled');
    }
});

function validaCheckbox() {
    var frm = document.form1;
    //Percorre os elementos do formulário
    for (i = 0; i < frm.length; i++) {
        //Verifica se o elemento do formulário corresponde a um checkbox 
        if (frm.elements[i].type == "checkbox") {
            //Verifica se o checkbox foi selecionado
            if (frm.elements[i].checked) {
                // alert("Exite ao menos um checkbox selecionado!");
                return true;
            }
        }
    }
    alert("Nenhum Aluno foi selecionado!");
    return false;
}
   