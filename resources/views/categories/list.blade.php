<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
            <a href="{{ route('categories.create') }}" class="text-sm text-gray-900 leading-tight"> Nova Categoria</a>
        </h2>
    </x-slot>

    <div class=" py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="col-md-10 offset-md-1 dashboard-products-container">
                                @if(count($categories))
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Ações</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $category->id}}</th>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                <form action="{{ route('categories.delete', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-blue-700 text-white py-1 px-2 rounded">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p>Ainda não existem categorias, <a href="{{ route('categories.create') }}">Cadastrar
                                        categoria</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </div>
</x-app-layout>
