<script>
    $(document).ready(function () {       
        //Data Table
        var table = $('#example_II').DataTable({
            //
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }],
          "lengthMenu": [[5, 10, 15, 20, 100, -1], [5, 10, 15, 20, "All"]],
            "language": {
                "lengthMenu": "_MENU_ ",
                "zeroRecords": "Nenhuma Turma encontrada",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registros",
                "search": "Busca:",
                "infoFiltered": "(filtrado de _MAX_ total de Turmas)",
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
    });
</script>
