 
<script>
    //Deixa os checkbox mais bonitos
    $(document).ready(function () {
        $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
    });
</script> 
<script>
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });
        //Data Table
        var table = $('#example').DataTable({
            //
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }],
            "lengthMenu": [[5, 10, 15, 20, 100, -1], [5, 10, 15, 20, "All"]],
            "language": {
                "lengthMenu": "_MENU_ ",
                "zeroRecords": "Nenhum Aluno(a) encontrada",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registros",
                "search": "Busca:",
                "infoFiltered": "(filtrado de _MAX_ Total de Alunos)",
                "paginate": {
                    "first": "Primeira",
                    "last": "Ultima",
                    "next": "Proxima",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": ative a ordenação cressente",
                    "sortDescending": ": ative a ordenação decressente"
                }
            },
            responsive: true
        });
        // Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });
    });

</script>
<script>
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
    });</script>
