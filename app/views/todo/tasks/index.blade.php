@extends('layouts.app')
@section('title', 'Edit RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-10 col-md-10 col-sm-10">
            <h1 class="mb-4">Todo List</h1>
            <a href="/todo/tasks/create" class="btn btn-success mb-3">Create Task</a>
            <div class="accordion" id="tasks-accordion">
                @foreach($tasks as $k=>$v)
                <div class="accordion-item mb-2">
                    <div class="accordion-header d-flex justify-content-between align-items-center row" id="task-{{$v['id']}}">
                        <h2 class="accordion-header col-12 col-md-6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#task-collapse-{{$v['id']}}" aria-expanded="false" aria-controls="task-collapse-{{$v['id']}}">
                                <span class="col-12 col-md-5"><i class="fa-solid fa-square-up-right"></i> <strong>{{$v['title']}} </strong></span>
                                <span class="col-5 col-md-3"><i class="fa-solid fa-person-circle-question"></i> {{$v['priority']}}</span>
                                <span class="col-5 col-md-3"><i class="fa-solid fa-hourglass-start"></i><span class="due-date">{{$v['finish_at']}}</span></span>
                            </button>
                        </h2>
                    </div>
                    <div id="task-collapse-{{$v['id']}}" class="accordion-collapse collapse row" aria-labelledby="task-{{$v['id']}}" data-bs-parent="#tasks-accordion">
                        <div class="accordion-body">
                            <p><strong><i class="fa-solid fa-layer-group"></i> Category:</strong>{{$v['category_name']}}</p>
                            <p><strong><i class="fa-solid fa-battery-three-quarters"></i> Status:</strong>{{$v['status']}}</p>
                            <p><strong><i class="fa-solid fa-person-circle-question"></i> Priority:</strong>{{$v['priority']}}</p>
                            <p><strong><i class="fa-solid fa-hourglass-start"></i> Due Date:</strong>{{$v['finish_date']}}</p>
                            <p><strong><i class="fa-solid fa-file-prescription"></i> Description:</strong>{{$v['description']}}</p>
                            <div class="d-flex justify-content-end">
                                <a href="edit.php?id={{$v['id']}}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <script>
                function updateRemainingTime() {
                    const dueDateElements = document.querySelectorAll('.due-date');
                    const now = new Date();

                    dueDateElements.forEach((element) => {
                        const dueDate = new Date(element.textContent);
                        const timeDiff = dueDate - now;

                        if (timeDiff > 0) {
                            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

                            element.textContent = `Days: ${days} Hours: ${hours}`;
                        } else {
                            element.textContent = 'Time is up';
                        }
                    });
                }

                updateRemainingTime();
                setInterval(updateRemainingTime, 60000); // Update every minute
            </script>
        </div>
    </div>
@endsection