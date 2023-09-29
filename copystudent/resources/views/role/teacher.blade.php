<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

</head>
<body>
<div class="p-9 text-gray-900" style="display:flex; flex-direction:row; justify-content : center;">
    <h2>adding a copy</h2>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first('message') }}
    </div>
@endif
<div class="py-1">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900" style="display:flex; flex-direction:row; justify-content:space-around;">
            <p id="key" ></p>
                <form method="POST" id="upload-form" enctype="multipart/form-data" action="{{ route('upload.store') }}">
                    @csrf
                    <input  id="teacher" class="hidden" name="teacher" value="{{auth()->user()->getName()}}">
                    <label>Course name:</label>
                    <input style="border-radius: 10px; border-color: black; border-width: 2px;" id="name" name="name">
                    <label>Student's name:</label>
                    <input style="border-radius: 10px; border-color: black; border-width: 2px;" id="student" name="student">
                    <br>
                    <input type="file" class="form-control-file" id="file" name="file" style="margin-top: 30px; justify-content: center; border-radius: 10px; border-width: 3px; padding-left: 75px; padding-bottom: 10px; padding-top: 10px;">
                    <button type="submit"  id="button" style="padding-left: 20px;">Submit</button>
                </form>
                <!-- les clé public et privée sont asymétrique
                cela signifie qu'ils sont irreversible donc génération par le client-->
                <!--la clé public RSA est généré à l'inscription -->
                <!-- clé AES pour chaque document -->
                <script>

                    document.getElementById('key').innerHTML = Route::get('get.key');
                </script>

            </div>
            @include('index.copies')
        </div>
    </div>
</div>
</body>
</html>
