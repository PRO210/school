<script>
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
//        $('#example tfoot th').each(function () {
//            var title = $(this).text();
//            $(this).html('<input type="text" placeholder="' + title + '" />');
//        });
        //Data Table
        var table = $('#example').DataTable({

            //
//            "columnDefs": [{
//                    "targets": 0,
//                    "orderable": false
//                     "order": [[ 3, "desc" ]]
//                }],

            "lengthMenu": [[8, 2, 3, 4, 5, 6, 7, 100, -1], [8, 2, 3, 4, 5, 6, 7, 100, "All"]],
            "language": {
                "lengthMenu": "_MENU_ ",
                "zeroRecords": "Nenhum Bimestre encontrado",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Sem registros",
                "search": "Busca:",
                "infoFiltered": "(filtrado de _MAX_ total de Bimestres)",
                "paginate": {
                    "first": "Primeira",
                    "last": "Ultima",
                    "next": "Proxima",
                    "previous": "Anterior"
                },
//                "aria": {
//                    "sortAscending": ": ative a ordenação cressente",
//                    "sortDescending": ": ative a ordenação decressente"
//                }
            },
            "ordering": false,
            responsive: true
        });
        // Apply the search
//        table.columns().every(function () {
//            var that = this;
//            $('input', this.footer()).on('keyup change', function () {
//                if (that.search() !== this.value) {
//                    that
//                            .search(this.value)
//                            .draw();
//                }
//            });
//        });
    });
</script>
