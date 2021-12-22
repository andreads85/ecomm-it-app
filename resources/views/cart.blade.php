<x-app-layout>
    <x-slot name="header">
    </x-slot>

    @php
    //echo "<pre>"; print_r($products_in_cart); echo "</pre>";
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="wrapper">
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SKU</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Quantità</th>
                            <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products_in_cart as $product_in_cart)
                            <tr class="products" id="prod-{{$product_in_cart->id}}">
                                <td>{{$product_in_cart->sku}}</td>
                                <td>{{$product_in_cart->name}}</td>
                                <td>{{number_format($product_in_cart->price, 2, ',', '')}}</td>
                                <td>{{$product_in_cart->pivot->quantity}}</td>
                                <td><button class="btn btn-danger del-prod-from-cart"><i class="bi bi-x-lg"></i></button></td>
                            </tr>
                            @empty
                                <p>Non ci sono prodotti nel tuo carrello.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>