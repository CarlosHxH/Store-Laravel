@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- LIST -->
            <div class=col-md-12>
                <legend>List of clients</legend>
                <table id="myTable" class="table table-striped table-bordered table-condensed table-hover"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th width="112px">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <div id="modal-cat" class="modal" tabindex="-1">
        <!--div class="modal fade" id="modal-cat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="modal-cat" aria-hidden="true"-->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cat-title">Adicionar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cat-id">
                    <label for="name">Categoria</label>
                    <input type="text" id="cat-name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button id="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>



    <div id="modal-delete" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <button id="del" class="btn btn-danger" data-bs-dismiss="modal">Sim</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('category') }}",
                columns: [
                    {data: 'name',name: 'name'},
                    {data: 'action',name: 'action',orderable: false},
                ],
                order: [[0, 'desc']]
            });

            $("#myTable_filter label").addClass('mx-5');
            $('#myTable_filter').append(`<label class="m-auto"><button id="new" class="btn btn-outline-primary px-5" data-bs-toggle="modal" data-bs-target="#modal-cat">new</button></label>`);

            $(document).on("click", ".btn-del", function() {
                $("#del").data('id', $(this).data('id'));
                $("#modal-delete").modal('show');
            })
            $(document).on("click", "#del", function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "DELETE",
                    url: "category/"+id,
                    dataType: 'json',
                    success: function(res) {
                        var table = $('#myTable').dataTable();
                        table.fnDraw(false);
                    }
                });
            });

            $(document).on('click','#new',function() {
                $('#cat-title').html("Adicionar");
                $('#cat-id').data('id','');
                $('#cat-name').val('');
                $('#modal-cat').modal('show');
            });

            $(document).on('click','.btn-edt',function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "category/"+id+"/edit",
                    dataType: 'json',
                    success: function(data) {
                        $('#cat-title').html("Editar Categoria");
                        $('#cat-id').data('id',data.id);
                        $('#cat-name').val(data.name);
                        $('#modal-cat').modal('show');
                    }
                });
            });

            $(document).on('click', '#submit', function() {
                $.ajax({
                    type: "POST",
                    url: "category",
                    data: {
                        id: $('#cat-id').data('id'),
                        product: $("#cat-name").val()
                    },
                    success: function(data) {
                        $("#modal-cat").modal('hide');
                        var table = $('#myTable').dataTable();
                        table.fnDraw(false);
                    }
                });
            });
        });
    </script>
@endsection
