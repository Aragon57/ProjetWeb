@if(isset($_SESSION['status']) && $_SESSION['status'] == 4)
<thead class="thead-dark">
    <tr>
        @if(!empty($columns))
            @foreach ($columns as $column)
                <th scope="col">{{ $column }}</th>
            @endforeach
        @endif
    </tr>
</thead>

<tbody>
    @foreach ($values as $value)
        <tr>
            @foreach ($value as $data)
                <td>{{ $data }}</td>
            @endforeach
        </tr>
    @endforeach
</tbody>
@else
<h1>Vous n'êtes pas authoriser a visualiser les informations!</h1>
@endif