<div>
<form action="{{ route('annonce.search') }}" enctype="multipart/form-data">
    @csrf

    <label for="name">Nom:</label>
    <input type="text" id="name" name="name" value="">


    <label for="min_price">Prix minimum:</label>
    <input type="number" id="min_price" name="min_price" value="">
    <label for="max_price">Prix maximum:</label>
    <input type="number" id="max_price" name="max_price" value="">

    <label for="preferences">Préférences:</label>
    <input type="text" id="preferences" name="preferences" value="">
    <label for="color">Couleur préférée:</label>
    <input type="text" id="color" name="color" value="">

    <input type="submit" >
</form>





<h1>Resultat d'annonce</h1>
@foreach($items as $item)
    <div>
        <span>titre : {{ $item->title }}</span>
        <span>description : {{ $item->description }}</span>
        <span>photographie :</span>
        @php
            $photographie = json_decode($item->photographie);
        @endphp
        @if($photographie && is_array($photographie))
            @foreach($photographie as $i)
                <img width='100px' height='100px' src="{{ asset('storage/uploads/'. $i) }}"  alt="">
            @endforeach
        @else
            <span>No photo available</span>
        @endif
        <span>prix : {{ $item->prix }}</span>
    </div>
    <a href="{{ route('annonce.see',  [ 'id' => $item->id]) }}">Modifier</a>
    <a href="{{ route('annonce.delete',  [ 'id' => $item->id]) }}">Supprimer</a>
@endforeach

</div>
