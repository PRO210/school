<script>
    $(document).ready(function () {        
        //Data Table
        var table = $('#example').DataTable({
            //
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false
                }],
            "lengthMenu": [[5,10 ,20, 30, 40, 50, 70, 100, -1], [5,10 ,20, 30, 40, 50, 70, 100, "All"]],
            "language": {
                "lengthMenu": "_MENU_ ",
                "zeroRecords": "Nenhum aluno encontrado",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registros",
                "search": "Busca:",
                "infoFiltered": "(filtrado de _MAX_ total de Disciplinas)",
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
