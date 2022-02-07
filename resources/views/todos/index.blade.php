<!-- extending from the layouts.app file -->

@extends('layouts.app')
@section('content')

<h1 class="text-center my-5">TODOS PAGE</h1>
        <!-- display the content in the view -->
        <!-- {{$todos}} -->
        <!-- display the content in an orderly way through looping -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        Todos
                        <!-- <a href="/create"><span class="btn btn-primary btn-sm float-right ">Create Todo</span></a> -->
                    </div>
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($todos as $todo)
                            <li class="list-group-item">
                                <!-- only display the name -->
                                {{$todo->name}}
                                <!-- for displaying the description -->
                                <!-- {{$todo->description}} -->
                                <!-- for displaying completed -->
                                <!-- {{$todo->completed}} -->
                                @if(!$todo->completed)
                                <a href="/todos/{{$todo->id}}/complete" style="color: white" class="btn btn-warning btn-sm  float-right">Complete</a>
                               @endif

                                <a href="/todos/{{$todo->id}}" class="btn btn-primary btn-sm float-right mr-2">View</a>
                              
                            </li>
                            @endforeach
                        </ul>

                    </div>


                </div>


            </div>

        </div>

@endsection