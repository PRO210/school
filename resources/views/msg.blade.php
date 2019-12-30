@if(session('msg'))
<!--Modal-->                <!--Modal-->            <!--Modal-->        
<div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" style=" color:black" >
                    {{session('msg')}}
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-danger " data-dismiss="modal">Prosseguir</button>-->
            </div>
        </div>
    </div>
</div> 
<script type='text/javascript'>
    $(document).ready(function () {
    $('#exemplomodal').modal('show');
    });
    var intervalo = window.setInterval(fechar, 4000);
    function fechar() {
    $('.modal').modal('hide');
    }
    @endif
</script>  
<!--//-->
<!--Caso ocorra algum erro-->
@if(session('msg_2'))
<!--Modal Erro-->                <!--Modal Erro-->            <!--Modal Erro-->        
<div class="modal fade" id="exemplomodal_2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style=" color:black" >
                    {{session('msg_2')}}
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-danger " data-dismiss="modal">Prosseguir</button>-->
            </div>
        </div>
    </div>
</div> 
<script type='text/javascript'>
            $(document).ready(function () {
    $('#exemplomodal_2').modal('show');
    });
    var intervalo = window.setInterval(fechar, 4000);
    function fechar() {
    $('.modal').modal('hide');
    }
    @endif
</script>
@if(session('msg_3'))
<!--Modal Erro-->                <!--Modal Erro-->            <!--Modal Erro-->        
<div class="modal fade" id="exemplomodal_3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" style=" color:black" >
                    {{session('msg_3')}}
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-danger " data-dismiss="modal">Prosseguir</button>-->
            </div>
        </div>
    </div>
</div> 

<script type='text/javascript'>
            $(document).ready(function () {

    $("input:text:eq(0):visible").css("border", "1px solid red ");
    $('#exemplomodal_3').modal('show');
    var intervalo = window.setInterval(fechar, 4000);
    function fechar() {
    $('.modal').modal('hide');
    $("input:text:eq(0):visible").focus();
    }

    var intervalo = window.setInterval(borda, 40000);
    function borda() {
    $("input:text:eq(0):visible").css("border", "1px solid #ddd");
    }
    });
    @endif
</script>



