@php
  $all = App\Product::orderBy('price', 'DESC')->get();
@endphp

@foreach ($all as $item)
<div class= "col-lg-4 col-md-6 mb-4 article {{ $item->id_category }} articles">  
  <div class="card h-100">
    <img src="http://127.0.0.1:8000/{{ $item->image }}" class="imgshop" alt="erreur" >

    <h4 class="card-title nom-article"> {{ $item->name }}</h4> 
    <h5 class="prix-article"> Prix :{{ $item->price }}€</h5>
    <p class="card-text">{{ $item->description }}</p>
    <button onclick="document.getElementById('addarcticle').style.display='block'" class="addtocart-btn" type="submit"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>

    <form action="/product/destroy" method="post">
      @csrf
      <input type="hidden" name="id_product" value = {{ $item->id }}>
    @php
    if($_SESSION['status']==4){
    @endphp
      <button type="submit" class="addtocart-btn"><i class="fas fa-trash-alt"></i></button>
         @php
    }
    @endphp
    </form>

  </div>

</div>
@endforeach