<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="product-create-container" class="col-md-6 offset-md-3">
                        @if ($errors->any())
                        <ul class="list-group list-group-error">
                            @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error}}</li>
                            @endforeach
                        </ul>

                        @endif
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="nome do produto" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="category" class="form-label">Categoria</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Selecione...</option>
                                    @foreach($categories as $category)
                                    <option value="{{ old('category_id') ?? $category->id }}">{{$category->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Descrição*</label>
                                <textarea class="form-control" name="description"
                                    id="description">{{ old('description') }}</textarea>
                                <p> *Opcional o preenchimento no formulário de cadastro</p>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="image" id="image" />
                            </div>
                            <div class="form-group" id="expirationDate">
                                <div class="form-group">
                                    <label for="price" class="form-label">Preço</label>
                                    <input type="text" class="form-control" name="price" id="price"
                                        value="{{ old('price') }}" />
                                </div>
                                <div class="form-group" id="expirationDate">
                                    <label for="expiration_date" class="form-label">Data de Vencimento</label>
                                    <input type="date" class="form-control" name="expiration_date" id="expiration_date"
                                        min={{now()}} value="{{ old('expiration_date') }}">
                                </div>
                                <button type="sumbit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
