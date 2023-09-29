<div class="p-9 text-gray-900" style="display:flex; flex-direction:row; justify-content : center;">
    <h2> application member </h2>
</div>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display:flex; flex-direction:row; justify-content:space-around;">
                    <table>
                        <tr>
                            <th>Cours</th>
                            <th>Note</th>
                            <th>Professeur</th>
                            <th>étudiant</th>
                        </tr>
                        @foreach ($tests as $test)
                            <tr>
                                <td>{{ $test->course }}</td>
                                <td>{{ $test->mark }}</td>
                                <td>{{ $test->teacher }}</td>
                                <td>{{$test->student}}</td>
                                <td><a href="{{ route('telecharger.fichier',['id'=>$test->id]) }}">Télécharger le fichier</a></td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>

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

