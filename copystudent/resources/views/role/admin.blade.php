<div class="p-9 text-gray-900" style="display:flex; flex-direction:row; justify-content : center;">
    <h2> application member </h2>
</div>
@foreach($users as $user)
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display:flex; flex-direction:row; justify-content:space-around;">

                    <p>{{$user->name}}</p>
                    <p>{{$user->email}}</p>

                    <form  method="POST" action="{{ route('accept',['user1'=>$user]) }}">
                        @csrf
                        <button type="submit" style="color : green;">accept subscription</button>
                        @method('POST')
                    </form>

                    <form  method="POST" action="{{ route('refuse',['user'=>$user]) }}">
                        @csrf
                        <button type="submit" style="color : red;">refuse subscription</button>
                        @method('POST')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="p-9 text-gray-900" style="display:flex; flex-direction:row; justify-content : center;">
    <h2>adding a course</h2>
</div>

<div class="py-1">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900" style="display:flex; flex-direction:row; justify-content:space-around;">
                <form method="POST" action="{{ route('addcourse') }}" >
                    @csrf
                    <label for="name"> course name : </label> <input style="border-radius: 10px; border-color: black;border-width: 2px;" id="name" name="name">
                    <label for="teacher"> teacher's name : </label><input style="border-radius: 10px; border-color: black;border-width: 2px;" id="teacher" name="teacher">
                    <button type="submit">Submit</button>
                    @method('PUT')
                </form>
            </div>
            @foreach($courses as $course)

                <div style="display: flex; flex-direction: row; justify-content: space-around; margin-top: 2px;margin-bottom: 2px;">
                    <div>{{$course->id}}</div>
                    <div>{{$course->course}}</div>
                    <div>{{$course->teacher}}</div>
                    <form method="POST" action="{{ route('removecourse',['id'=>$course->id]) }}">
                        @csrf
                        <button type="submit">Remove Course</button>
                        @method('DELETE')
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
