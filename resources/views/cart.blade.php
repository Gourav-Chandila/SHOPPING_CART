@extends('layouts.app')

@section('title', 'Cart')

@section('styles')
    <!-- Additional styles specific to this view -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
    @include('navbar')


    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Cart</b></h4>
                        </div>
                    </div>
                </div>

                {{-- Cart items --}}
                @if (!empty($selectedProducts) && is_array($selectedProducts))
                    @foreach ($selectedProducts as $selectedProduct)
                        @php
                            $uniqueProductIdTo = $selectedProduct['product_id_to'] . '_' . $selectedProduct['size'];
                            $size = $selectedProduct['size'];

                        @endphp
                        <div id="item-{{ $uniqueProductIdTo }}" class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid"
                                        src="{{ asset($selectedProduct['productImage']) }}">
                                </div>
                                <div class="col">
                                    <div class="row text-muted">{{ htmlspecialchars($selectedProduct['productName']) }}
                                    </div>
                                    <div class="row">Size : {{ $selectedProduct['size'] }}</div>
                                </div>

                                {{-- Quantity controls --}}
                                <div class="quantity-controls">
                                    <a href="#" onclick="decrementQuantity(); event.preventDefault();">-</a>
                                    <span id="quantity-' . $key . '">{{ $selectedProduct['quantity'] }}</span>
                                    <a href="#" onclick="incrementQuantity(''); event.preventDefault();">+</a>
                                </div>

                                <div class="col"></div>
                                <div class="col ">&#8377; {{ $selectedProduct['price'] }}
                                    {{-- <span class="close"onclick="">&#10005;</span> --}}
                                    <span class="close"
                                        onclick="removeItem('{{ $uniqueProductIdTo }}', '{{ $size }}')">&#10005;</span>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No products found.</p>
                @endif

                <div class="back-to-shop">
                    <a href="#">&leftarrow;</a>
                    <span class="">Back to shop</span>
                </div>
            </div>

            {{-- SUMMARY --}}
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>

                {{-- Shows cart count with item price --}}
                @if ($cartCount > 0)
                    <div class="row">
                        <div class="col" style="padding-left:0;" id="itemsCount">ITEMS {{ $cartCount }}</div>
                        <div class="col text-right text-danger" id="totalPrice">&#8377;Total item price: <span
                                id="totalPriceValue"></span></div>
                    </div>
                @else
                    No items in the cart.
                @endif

                {{-- Form Shipping and coupon code --}}
                <form>
                    <p>SHIPPING</p>
                    <select>
                        <option class="text-muted">Standard-Delivery- &#8377;40</option>
                    </select>
                    <p>GIVE CODE</p>
                    <input id="code" placeholder="Enter your code">
                </form>

                {{-- TOTAL PRICE --}}
                @if ($cartCount > 0)
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        @if (1 === 1)
                            {{-- $totalPrice += 00; --}}
                        @endif
                    </div>
                @else
                    {{-- $totalPrice += 40; --}}
                    <div class="col text-right text-danger" id="finalPrice">&#8377; </div>
                @endif

                <a class="btn" href="checkout_page.php">CHECKOUT</a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function removeItem(uniqueProductIdTo, size) {
            var xhr = new XMLHttpRequest();

            xhr.open('GET', '{{ route('remove.item') }}?product_id_to=' + uniqueProductIdTo + '&size=' +
                encodeURIComponent(size));
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Item removed successfully, update the cart view
                            var itemToRemove = document.getElementById('item-' + uniqueProductIdTo);
                            itemToRemove.parentNode.removeChild(itemToRemove);
                            // You might need to update other parts of the cart view as well (e.g., total price)
                        } else {
                            // Handle failure scenario
                            console.error('Failed to remove item from the cart.');
                        }
                    } else {
                        console.error('Error:', xhr.status, xhr.statusText);
                    }
                }
            };
            xhr.send();
        }
    </script>

@endsection
