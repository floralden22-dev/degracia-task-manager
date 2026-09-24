<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task</title>

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
            max-width: 900px;
            margin: auto;
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
            width: min(900px, 90%);
            margin: 55px auto 70px;
        }

        .back {
            display: inline-block;
            color: #718078;
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 24px;
        }

        .back:hover {
            color: #4f6256;
        }

        .intro {
            margin-bottom: 28px;
        }

        .intro h1 {
            font-size: 34px;
            font-weight: 700;
            color: #292d2a;
            letter-spacing: -0.8px;
            margin-bottom: 8px;
        }

        .intro p {
            color: #7b8079;
            font-size: 14px;
        }

        .form-card {
            background: #ffffff;
            border: 1px solid #e5e2da;
            border-radius: 12px;
            padding: 32px;
        }

        .form-group {
            margin-bottom: 23px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #454b45;
            margin-bottom: 8px;
        }

        .required {
            color: #a06c63;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid #dcded8;
            border-radius: 7px;
            background: #fcfcfa;
            color: #343934;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            padding: 12px 13px;
            outline: none;
            transition: 0.2s ease;
        }

        input {
            height: 48px;
        }

        textarea {
            min-height: 115px;
            resize: vertical;
        }

        select {
            height: 48px;
            cursor: pointer;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #8b9b90;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(113, 133, 121, 0.1);
        }

        .error {
            margin-top: 6px;
            color: #a06c63;
            font-size: 12px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 10px;
        }

        .button {
            min-width: 110px;
            height: 44px;
            padding: 0 18px;
            border-radius: 7px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s ease;
        }

        .cancel {
            color: #657068;
            background: #f4f5f2;
            border: 1px solid #dfe2dc;
        }

        .cancel:hover {
            background: #ebeee9;
        }

        .save {
            color: #ffffff;
            background: #607568;
            border: 1px solid #607568;
        }

        .save:hover {
            background: #50655a;
        }

        @media (max-width: 650px) {
            .header {
                padding: 20px 5%;
            }

            .container {
                width: 92%;
                margin-top: 40px;
            }

            .intro h1 {
                font-size: 30px;
            }

            .form-card {
                padding: 23px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .button {
                width: 100%;
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

        <a href="/tasks" class="back">
            ← Back to tasks
        </a>

        <section class="intro">
            <h1>Edit task</h1>
            <p>Update the details of your task below.</p>
        </section>

        <div class="form-card">

            <form action="/tasks/{{ $task->id }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="task_name">
                        Task name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name', $task->task_name) }}"
                        placeholder="Enter task name"
                    >

                    @error('task_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Add a description (optional)"
                    >{{ old('description', $task->description) }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="due_date">
                            Due date
                        </label>

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
                        <label for="status">
                            Status
                        </label>

                        <select id="status" name="status">

                            <option
                                value="Pending"
                                {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="Completed"
                                {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}
                            >
                                Completed
                            </option>

                        </select>

                        @error('status')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="actions">

                    <a href="/tasks" class="button cancel">
                        Cancel
                    </a>

                    <button type="submit" class="button save">
                        Save changes
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>
