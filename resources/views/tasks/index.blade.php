<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TaskList</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #eef1f3;
            color: #263238;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 235px;
            background: #173f43;
            color: white;
            padding: 30px 20px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 45px;
            padding-left: 10px;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .nav a {
            color: #dbe7e7;
            text-decoration: none;
            padding: 12px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .nav a:hover,
        .nav a.active {
            background: #28575b;
            color: white;
        }

        .main {
            flex: 1;
            padding: 35px 45px;
            overflow-x: hidden;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #173f43;
        }

        .page-subtitle {
            margin-top: 7px;
            font-size: 14px;
            color: #718083;
        }

        .add-button {
            background: #173f43;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
        }

        .add-button:hover {
            background: #28575b;
        }

        .success {
            background: #dceee8;
            color: #286052;
            border-left: 4px solid #438878;
            padding: 13px 16px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat {
            background: white;
            border: 1px solid #dfe5e6;
            padding: 22px;
            border-radius: 6px;
        }

        .stat-label {
            color: #7a888a;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
            color: #173f43;
        }

        .content-card {
            background: white;
            border: 1px solid #dfe5e6;
            border-radius: 6px;
            overflow: hidden;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #e6eaeb;
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
            color: #263f42;
        }

        .card-link {
            color: #39777a;
            text-decoration: none;
            font-size: 13px;
        }

        .task-list {
            width: 100%;
        }

        .task-row {
            display: grid;
            grid-template-columns: 2fr 1.2fr 1fr 1fr;
            align-items: center;
            gap: 15px;
            padding: 18px 24px;
            border-bottom: 1px solid #edf0f1;
        }

        .task-row:last-child {
            border-bottom: none;
        }

        .task-name {
            font-size: 14px;
            font-weight: 600;
            color: #263238;
        }

        .task-description {
            margin-top: 5px;
            font-size: 12px;
            color: #879294;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .date {
            font-size: 13px;
            color: #657477;
        }

        .status {
            display: inline-block;
            width: fit-content;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
        }

        .pending {
            background: #f3ead1;
            color: #80672a;
        }

        .completed {
            background: #dceee8;
            color: #286052;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .actions a,
        .actions button {
            background: none;
            border: none;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
        }

        .edit {
            color: #39777a;
        }

        .delete {
            color: #a04d4d;
        }

        .empty {
            text-align: center;
            padding: 55px 20px;
            color: #879294;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 190px;
            }

            .main {
                padding: 30px 25px;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .task-row {
                grid-template-columns: 2fr 1fr 1fr;
            }

            .actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 650px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 20px;
            }

            .brand {
                margin-bottom: 20px;
            }

            .nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .main {
                padding: 25px 18px;
            }

            .topbar {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .task-row {
                display: block;
            }

            .task-row > div {
                margin-bottom: 10px;
            }

            .actions {
                margin-top: 12px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">
        <div class="brand">TASKLIST</div>

        <nav class="nav">
            <a href="{{ route('tasks.index') }}" class="active">Dashboard</a>
            <a href="{{ route('tasks.index') }}">My Tasks</a>
            <a href="{{ route('tasks.create') }}">Add Task</a>
        </nav>
    </aside>

    <main class="main">

        <div class="topbar">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Keep track of your tasks and upcoming work.</p>
            </div>

            <a href="{{ route('tasks.create') }}" class="add-button">+ Add Task</a>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <section class="stats">

            <div class="stat">
                <div class="stat-label">Total Tasks</div>
                <div class="stat-number">{{ $totalTasks }}</div>
            </div>

            <div class="stat">
                <div class="stat-label">Pending</div>
                <div class="stat-number">{{ $pendingTasks }}</div>
            </div>

            <div class="stat">
                <div class="stat-label">Completed</div>
                <div class="stat-number">{{ $completedTasks }}</div>
            </div>

            <div class="stat">
                <div class="stat-label">Overdue</div>
                <div class="stat-number">{{ $overdueTasks }}</div>
            </div>

        </section>

        <section class="content-card">

            <div class="card-header">
                <div class="card-title">Recent Tasks</div>

                <a href="{{ route('tasks.index') }}" class="card-link">
                    View all
                </a>
            </div>

            @if($tasks->count())

                <div class="task-list">

                    @foreach($tasks as $task)

                        <div class="task-row">

                            <div>
                                <div class="task-name">
                                    {{ $task->task_name }}
                                </div>

                                @if($task->description)
                                    <div class="task-description">
                                        {{ $task->description }}
                                    </div>
                                @endif
                            </div>

                            <div>
                                @if($task->status === 'Completed')
                                    <span class="status completed">
                                        Completed
                                    </span>
                                @else
                                    <span class="status pending">
                                        Pending
                                    </span>
                                @endif
                            </div>

                            <div class="date">
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No date' }}
                            </div>

                            <div class="actions">

                                <a
                                    href="{{ route('tasks.edit', $task) }}"
                                    class="edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('tasks.destroy', $task) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete"
                                        onclick="return confirm('Delete this task?')"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty">
                    <p>No tasks have been added yet.</p>
                </div>

            @endif

        </section>

    </main>

</div>

</body>
</html>