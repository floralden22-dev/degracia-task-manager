<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - TaskList</title>

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
        }

        .topbar {
            margin-bottom: 30px;
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

        .form-card {
            max-width: 800px;
            background: white;
            border: 1px solid #dfe5e6;
            border-radius: 6px;
            padding: 30px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #344447;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #cfd8da;
            border-radius: 5px;
            background: white;
            color: #263238;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #39777a;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .error {
            margin-top: 6px;
            color: #a04d4d;
            font-size: 12px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #e6eaeb;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 5px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .save-button {
            background: #173f43;
            color: white;
            border: 1px solid #173f43;
        }

        .save-button:hover {
            background: #28575b;
            border-color: #28575b;
        }

        .cancel-button {
            background: white;
            color: #39777a;
            border: 1px solid #cfd8da;
        }

        .cancel-button:hover {
            background: #f4f6f6;
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

            .form-card {
                padding: 22px;
            }

            .form-actions {
                flex-direction: column;
            }

            .button {
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">
        <div class="brand">TASKLIST</div>

        <nav class="nav">
            <a href="{{ route('tasks.index') }}">Dashboard</a>
            <a href="{{ route('tasks.index') }}">My Tasks</a>
            <a href="{{ route('tasks.create') }}">Add Task</a>
        </nav>
    </aside>

    <main class="main">

        <div class="topbar">
            <h1 class="page-title">Edit Task</h1>
            <p class="page-subtitle">Update the details of your task.</p>
        </div>

        <div class="form-card">

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="task_name">Task Name</label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name', $task->task_name) }}"
                        required
                    >

                    @error('task_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                    >{{ old('description', $task->description) }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', $task->due_date) }}"
                    >

                    @error('due_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>

                    <select id="status" name="status" required>
                        <option
                            value="Pending"
                            {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="Completed"
                            {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}
                        >
                            Completed
                        </option>
                    </select>

                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a
                        href="{{ route('tasks.index') }}"
                        class="button cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="button save-button"
                    >
                        Save Changes
                    </button>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>