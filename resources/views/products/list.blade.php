<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
            <a href="{{ route('products.create') }}" class="text-sm text-gray-900 leading-tight"> 
                Novo produto
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="col-md-12 dashboard-products-container">
                        <div id="search-container" class="col-md-12">
                            <h1>Busque um Produto</h1>
                            <form action="{{ route('products.list') }}" method="GET" class="row g-3">
                                <div class="col-auto">
                                    <input type="text" id="search" name="search" class="form-control"
                                        placeholder="Procurar...">
                                </div>

                                <div class="col-auto">
                                    <a href="{{route('products.list')}}" class="btn btn-secondary edit-btn">Exibir
                                        todos</a>
                                </div>
                            </form>
                        </div>
                        @if(count($products))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Dt. Vencimento</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    @foreach ($categories as $category)
                                    @if ($product->category_id === $category->id)
                                    <td>{{$category->name}}</td>
                                    @endif
                                    @endforeach
                                    <td><img src="{{ url("storage/{$product->image}") }}" alt="" class="img-product">
                                    </td>
                                    <td>{{date('d/m/Y',strtotime($product->expiration_date))}}</td>
                                    <td>{{$product->sku_product}}</td>
                                    <td>
                                        <a href="{{route('products.edit', $product->id)}}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                            Editar
                                        </a>
                                        <form action="{{ route('products.delete', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @elseif(!count($categories))
                        <p>Ainda não existem categorias, É necessário <a
                                href="{{ route('categories.create') }}">cadastrar as categorias</a> antes
                        </p>

                        @else
                        <p>Ainda não existem produtos, <a href="{{ route('products.create') }}">Cadastrar produto</a>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
