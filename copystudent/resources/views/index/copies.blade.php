@if(auth()->user()->role==='teacher')

    <table>
        <tr>
            <th>id of the copy</th>
            <th>Course</th>
            <th>Student</th>
            <th>Graded</th>
        </tr>
        @foreach ($copies as $copy)
            <tr>
                <td>{{ $copy->id }}</td>
                <td>{{ $copy->course }}</td>
                <td>{{ $copy->student }}</td>
                <td>@if ($copy->graded === 0)

                        @include('index.edit',[$copy])
                    @else
                        <div>{{$copy->mark}}</div>

                    @endif</td>
                <td><form method="POST" action="{{ route('copies.destroy',['id'=>$copy->id]) }}">
                        @csrf
                        <button type="submit">Remove Copy</button>
                        @method('DELETE')
                    </form></td>
                <td><a href="{{ route('telecharger.fichier',['id'=>$copy->id]) }}">Télécharger le fichier</a></td>
            </tr>
        @endforeach

    </table>



<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
@endif
