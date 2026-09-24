<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tasks</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            background: #f5f3ee;
            color: #30332f;
        }

        .header {
            background: #ffffff;
            border-bottom: 1px solid #e7e4dc;
            padding: 22px 7%;
        }

        .header-inner {
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            color: #35433a;
        }

        .brand span {
            color: #718579;
        }

        .container {
            width: min(1100px, 90%);
            margin: 55px auto 70px;
        }

        .intro {
            margin-bottom: 32px;
        }

        .intro h1 {
            font-size: 36px;
            font-weight: 700;
            color: #292d2a;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .intro p {
            font-size: 15px;
            color: #777b75;
        }

        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #414740;
        }

        .task-count {
            color: #858981;
            font-size: 13px;
            margin-left: 6px;
        }

        .add-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            border-radius: 8px;
            background: #607568;
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .add-button:hover {
            background: #50655a;
        }

        .success {
            margin-bottom: 25px;
            padding: 13px 16px;
            background: #edf4ef;
            border: 1px solid #d6e4da;
            color: #58705f;
            border-radius: 8px;
            font-size: 13px;
        }

        .task-list {
            background: #ffffff;
            border: 1px solid #e5e2da;
            border-radius: 12px;
            overflow: hidden;
        }

        .task {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto auto;
            align-items: center;
            gap: 25px;
            padding: 22px 24px;
        }

        .task + .task {
            border-top: 1px solid #eeece6;
        }

        .task:hover {
            background: #fcfcfa;
        }

        .task-name {
            font-size: 15px;
            font-weight: 600;
            color: #353a35;
            margin-bottom: 6px;
        }

        .description {
            font-size: 13px;
            line-height: 1.5;
            color: #81857e;
        }

        .due-date {
            font-size: 12px;
            color: #9a9d96;
            margin-top: 7px;
        }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status.pending {
            background: #f5efe2;
            color: #90724a;
        }

        .status.completed {
            background: #e9f1eb;
            color: #55705d;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .action {
            min-width: 58px;
            height: 34px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .edit {
            background: #f2f4f1;
            border: 1px solid #dce1dc;
            color: #596b5e;
        }

        .edit:hover {
            background: #e9eee9;
        }

        .delete {
            background: #faf1ef;
            border: 1px solid #ecd9d5;
            color: #a06c63;
        }

        .delete:hover {
            background: #f5e6e2;
        }

        .empty {
            text-align: center;
            padding: 65px 25px;
        }

        .empty h2 {
            font-size: 20px;
            color: #414740;
            margin-bottom: 8px;
        }

        .empty p {
            color: #888c85;
            font-size: 14px;
            margin-bottom: 20px;
        }

        @media (max-width: 750px) {
            .header {
                padding: 20px 5%;
            }

            .container {
                width: 92%;
                margin-top: 40px;
            }

            .intro h1 {
                font-size: 31px;
            }

            .top-actions {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .add-button {
                width: 100%;
            }

            .task {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .actions {
                width: 100%;
            }

            .action {
                flex: 1;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <div class="header-inner">
            <div class="brand">
                Task<span>List</span>
            </div>
        </div>
    </header>

    <main class="container">

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <section class="intro">
            <h1>My tasks</h1>
            <p>Keep track of your work and stay on top of your deadlines.</p>
        </section>

        <div class="top-actions">
            <div>
                <span class="section-title">All tasks</span>
                <span class="task-count">
                    {{ $tasks->count() }}
                    {{ $tasks->count() == 1 ? 'task' : 'tasks' }}
                </span>
            </div>

            <a href="/tasks/create" class="add-button">
                Add task
            </a>
        </div>

        <section class="task-list">

            @forelse($tasks as $task)

                <div class="task">

                    <div>
                        <div class="task-name">
                            {{ $task->task_name }}
                        </div>

                        @if($task->description)
                            <div class="description">
                                {{ $task->description }}
                            </div>
                        @endif

                        @if($task->due_date)
                            <div class="due-date">
                                Due {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <span class="status {{ strtolower($task->status) }}">
                            {{ $task->status }}
                        </span>
                    </div>

                    <div class="actions">

                        <a
                            href="/tasks/{{ $task->id }}/edit"
                            class="action edit"
                        >
                            Edit
                        </a>

                        <form
                            action="/tasks/{{ $task->id }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this task?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="action delete"
                            >
                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="empty">
                    <h2>No tasks yet</h2>

                    <p>
                        Add a task to get started.
                    </p>

                    <a href="/tasks/create" class="add-button">
                        Add task
                    </a>
                </div>

            @endforelse

        </section>

    </main>

</body>
</html>
