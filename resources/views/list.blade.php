<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            body {
                background-color: c3d7e1; 
            }
            h1 {
                text-align: center;
                padding-top: 30px;
                padding-bottom: 40px;
            }
            #tasks {
                margin-left: 5%;
                font-size: 25px;
            }
            input[type=text] {
                width: 70%;
                height: 40px;
                border-radius: 10px;
                padding-top: 10px;
                padding-right: 10px;
                padding-bottom: 10px;
                padding-left: 10px;
            }
            button {
                border-radius: 5px;
                width: 120px;
                height: 35px;
            }
            input[type=checkbox] {
                margin-right: 10px;
                border-radius: 5px;
            }
        </style> 
    </head>

    <body>

        <h1>To-Do List</h1>
        
        <div class="text-center mb-3">
            <form action="/save-task" method="post">
                @csrf

                <input name="task_name" type="text" placeholder="What needs to be done?" />
                <button type="submit">Save Task</button>
            </form>
        </div>

        <div id="tasks">
        @if (count($tasks) > 0)

            @foreach ($tasks as $task)

            <input type="checkbox" class="task-item" data-task-id="{{ $task->id }}" @if ($task->is_completed)checked="checked"@endif>{{ $task->name }}<br />

            @endforeach

        @else

            You don't have any tasks

        @endif
        </div>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            axios.get('/api/foo')
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

            var tasks = jQuery('#tasks .task-item');
            tasks.on('change', function(e) {
                task_id = $(this).data('task-id');
                toggleItemState(task_id, this.checked);
            });

            function toggleItemState(taskId, state) {
                if (state) {
                    markCompleted(taskId);
                } else {
                    markIncomplete(taskId);
                }
            }

            function markCompleted(taskId) {
                axios.post('/api/task/mark-complete', {
                    task_id: taskId
                },{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }

            function markIncomplete(taskId) {
                axios.post('/api/task/mark-incomplete', {
                    task_id: taskId
                },{
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        });
    </script>
</html>