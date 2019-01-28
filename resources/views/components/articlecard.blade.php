@php
    function loadcard($item, $header)
    {
@endphp

        <div class="card">
			<img class="card-img-top" src="http://127.0.0.1:8000/{{ $item->image }}" alt="Card image cap">
			<div class="card-block">
				<h4 class="card-title nom-article">{{ $item->name }}</h4>
				<p class="card-text prix-article">Prix: {{ $item->price }}€</p>
				<p class="card-text">{{ $item->description }}</p>
				<button onclick="document.getElementById('product{{ $item->id }}').style.display='block'" class="addtocart-btn" type="submit"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                
                @php if($header) { @endphp
				    <form action="/product/destroy" method="post">
					    @csrf
					    <input type="hidden" name="id_product" value ={{ $item->id }}>
					    <button type="submit" class="addtocart-btn"><i class="fas fa-trash-alt"></i></button>
                    </form>
                @php } @endphp
			</div>
		</div>

@php
    }
@endphp
                          