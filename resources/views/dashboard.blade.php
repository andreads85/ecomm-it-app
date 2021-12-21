<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="wrapper">
                <div class="container">
                    <div class="row g-1">
                        @foreach ($products as $product)
                        <div class="col-md-3">
                            <div class="card p-3">
                                <div class="text-center"> <img src="{{$product->image}}"> </div>
                                <div class="product-details">
                                    <span class="font-weight-bold d-block">&euro; {{number_format($product->price, 2, ',', '')}}</span>
                                    <span>{{\Illuminate\Support\Str::limit($product->name, 80, '...')}}</span>
                                    <div class="buttons d-flex flex-row">
                                        <div class="cart"><i class="fa fa-shopping-cart"></i></div>
                                        <button class="btn btn-success cart-button btn-block" data-id="{{$product->id}}">Aggiungi al carrello </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Prodotto aggiunto con successo.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Continua ad acquistare</button>
                                <a class="btn btn-primary" href="{{route('cart_detail')}}">Carrello</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>