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
@foreach($items as $item)

<form action="{{ route('annonce.edit', ['id' => $item->id]) }}"  method="post" enctype="multipart/form-data">
    @csrf
    
    <table>
        <tr>
            <td>Titre</td>
            <td><input type="text" name="title" value="{{ $item->title }}"></td>
        </tr>
        <tr>
            <td>description</td>
            <td><input  name="description" value='{{ $item->description }}' ></td>
        </tr>
        <tr>
            <td>photographie</td>
            <td><input type='file'  name="photographie" ></td>
        </tr>
         <tr>
            <td>prix</td>
            <td><input type="number" name="prix" value="{{ $item->prix }}"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" />
            </td>
        </tr>
    </table>
</form>
@endforeach
