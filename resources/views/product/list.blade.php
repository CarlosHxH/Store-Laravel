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
        </div>

        <div class="row">
            <div class="col-md-12 text-end mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-product">
                    Novo produto
                </button>
            </div>
            @foreach ($products as $product)
                <div class="col-md-3 mb-2">
                    <div class="card p-2">
                        <div class="text-center" style="height:150px">
                            <img class="card-img-top w-auto h-100" src="{{ $product->file }}" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted ">{{ $product->description }}</h6>
                            <p class="card-text">Categoria:</p>
                            Preço
                        </div>
                        <div class="card-footer text-center">
                            <button data-id='{{ $product->id }}' type="button" class="btn btn-danger btn-del"
                                data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-edit" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="new-product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="new-product" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Novo produto</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-inline form-control form-label-group">
                        <input id="file" type="file" name="files" hidden>
                        <label for="file" class="form-control"><i class="fas fa-image"></i>
                            Select Image
                        </label>
                    </div>
                    <section class="file-area mt-1 mb-1">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <ul class="image-list mb-1">
                                        <img class="img-thumbal" id="view" src="" height="100px">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="mb-3">
                                <label for="product" class="form-label">Produto</label>
                                <input type="text" value="Camisa" class="form-control" id="product"
                                    placeholder="Produto" aria-label="Produto">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="product" class="form-label">Preço</label>
                            <input type="number" id="price" class="form-control" placeholder="Preço"
                                aria-label="Preço">
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <label for="stock" class="form-label">Estoque</label>
                            <input type="number" id="stock" class="form-control" placeholder="Estoque"
                                aria-label="stock">
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <label for="category" class="form-label">Categoria</label>
                            <select id="category" class="form-select">
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button id="submit" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-cloud-upload-alt"></i>Salvar
                    </button>
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
        function display(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#view').attr('src', event.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file").change(function() {
            display(this);
        });


        $(document).on("click", "#submit", function() {
            var formData = new FormData();
            formData.append('file', $('#file')[0].files[0]);
            formData.append("name", $("#product").val());
            formData.append("price", $("#price").val());
            formData.append("stock", $("#stock").val());
            formData.append("category", $("#category").val());
            formData.append("description", $("#description").val());

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('product.store') }}',
                type: 'POST',
                data: formData,
                cache: false,
                encode: true,
                contentType: false,
                processData: false,
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.success) {
                        window.location.reload(true);
                    } else {
                        console.log("erro");
                    }
                }
            });
        });

        $(document).on("click", ".btn-del", function() {
            $("#del").data('id', $(this).data('id'));
            $("#modal-delete").modal('show');
        });
        $(document).on("click", "#del", function() {
            let id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "product/" + id,
                dataType: 'json',
                success: function(res) {
                    window.location.reload(true);
                }
            });
        })
    </script>
@endsection
