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
                <legend>Produtos</legend>
                <table id="myTable" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th width="112px">Actions</th>
                        </tr>
                    </thead>
                </table>
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
                ajax: "{{ url('product') }}",
                columns: [
                    {data: 'name',name: 'name'},
                    {data: 'price',name: 'price'},
                    {data: 'stock',name: 'stock'},
                    {data: 'action',name: 'action',orderable: false},
                ],
                order: [[0, 'desc']]
            });

            $("#myTable_filter label").addClass('mx-5');
            $('#myTable_filter').append(`<label class="m-auto"><a href="{{route('product.create')}}" class="btn btn-outline-primary px-5">new</a></label>`);

            $(document).on("click", ".btn-del", function() {
                $("#del").data('id', $(this).data('id'));
                $("#modal-delete").modal('show');
            })
            $(document).on("click", "#del", function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "DELETE",
                    url: "product/"+id,
                    dataType: 'json',
                    success: function(res) {
                        var table = $('#myTable').dataTable();
                        table.fnDraw(false);
                    }
                });
            });
        });
    </script>
@endsection
