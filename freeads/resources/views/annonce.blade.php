@if(session()->has('success'))
    <p>
        {{ session()->get('success') }}
    </p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('annonce.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <table>
        <tr>
            <td>Titre</td>
            <td><input type="text" name="title" value=""></td>
        </tr>
        <tr>
            <td>description</td>
            <td><textarea  name="description" ></textarea></td>
        </tr>
        <tr>
            <td>photographie</td>
            <td><input type='file' multiple  name="photographie[]" ></td>
        </tr>
         <tr>
            <td>prix</td>
            <td><input type="number" name="prix" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" />
            </td>
        </tr>
    </table>
</form>





<h1>List d'annonce</h1>


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
