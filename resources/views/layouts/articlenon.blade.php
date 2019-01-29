@php
session_start();
  $all = App\Product::all();
@endphp

@include('components/articlecard')

@foreach ($all as $item)
<div id="card-spot" class="card-deck col-lg-4 col-md-6 mb-4 article {{ $item->id_category }} rezize-div">
  @php loadcard($item, true); @endphp
</div>
<div class="w3-container" style="padding: 0;">
  <div id="product{{ $item->id }}" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:3000px">
      <div class="w3-center"><br>
        <span onclick="document.getElementById('product{{ $item->id }}').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      @if(isset($_SESSION['id']))
        <form id="addtocart{{ $item->id }}" class="w3-container" action="/tocart" method="post" enctype="multipart/form-data" >
          @csrf
          <div class="w3-section">
            <input class="w3-input w3-border w3-margin-bottom" type="hidden" name="id_product" value={{ $item->id }}>
            <input class="w3-input w3-border w3-margin-bottom" type="hidden" name="id_user" value={{ $_SESSION['id'] }}>
            <input class="w3-input w3-border w3-margin-bottom" type="integer" name="quantity" value="1" required>

            <button id="ok-btn" type="submit">Confirmer</button>
          </div>
        </form>
      @endif
    </div>
  </div>
</div>

<script>
  $(document).ready(()=>{
    $('#addtocart{{ $item->id }}').submit((event)=>{
      event.preventDefault();

      let form = $('#addtocart{{ $item->id }}');

      $.ajax({
        type : 'POST',
        url : '/tocart',
        data : form.serialize(),
        dataType : 'text',
        encode : true,
        success : (data) => {
          console.log("true");
          console.log(data);
        },
        error : (data) => {
          console.log("false");
          console.log(data);
        }
      });
    });
  });
</script>
@endforeach