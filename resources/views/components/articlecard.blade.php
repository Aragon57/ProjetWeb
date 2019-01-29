@php
    function loadcard($item, $header)
    {
@endphp

        <div class="card">
			<img class="card-img-top" src="/storage/{{ $item->image }}" alt="Card image cap">
			<div class="card-block">
				<h4 class="card-title nom-article">{{ $item->name }}</h4>
				<p class="card-text prix-article">Prix: {{ $item->price }}€</p>
				<p class="card-text">{{ $item->description }}</p>
				@if(isset($_SESSION['email']))
				<button onclick="document.getElementById('product{{ $item->id }}').style.display='block'" class="addtocart-btn" type="submit"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                @endif
                @php if($header) { @endphp
                @if(isset($_SESSION['email']))
                @if($_SESSION['status']==4)
				    <form action="/product/destroy" method="post">
					    @csrf
					    <input type="hidden" name="id_product" value ={{ $item->id }}>
					    <button type="submit" class="addtocart-btn"><i class="fas fa-trash-alt"></i></button>
                    </form>
                   @endif
                   @endif
                @php } @endphp
			</div>
		</div>

@php
    }
@endphp
                          