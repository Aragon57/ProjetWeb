<thead class="thead-dark">
    <tr>
        @php if(!empty($columns)) @endphp
            @foreach ($columns as $column)
                <th scope="col">{{ $column }}</th>
            @endforeach
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