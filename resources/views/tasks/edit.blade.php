<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Task</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/style.css') }}"
    >

</head>

<body>

    <!-- Animated Background -->
    <div class="live-background">

        <div class="live-grid"></div>

        <div class="glow-orb blue-orb"></div>
        <div class="glow-orb purple-orb"></div>

        <div class="particles">

            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>

        </div>

    </div>


    <div class="container">

        <!-- Page Header -->
        <div class="form-page-header">

            <div class="welcome-text">
                PERSONAL TASK MANAGER
            </div>

            <h1>Edit Task</h1>

            <p class="subtitle">
                Update the information of your task.
            </p>

        </div>


        <!-- Validation Errors -->
        @if($errors->any())

            <div class="error-list">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Form -->
        <div class="form-card">

            <form
                action="{{ route('tasks.update', $task) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <!-- Task Name -->
                <div class="form-group">

                    <label for="task_name">
                        Task Name
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name', $task->task_name) }}"
                        placeholder="Enter task name"
                        required
                    >

                </div>


                <!-- Description -->
                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Enter task description"
                    >{{ old('description', $task->description) }}</textarea>

                </div>


                <!-- Status and Priority -->
                <div class="form-row">

                    <div class="form-group">

                        <label for="status">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                        >

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

                    </div>


                    <div class="form-group">

                        <label for="priority">
                            Priority
                        </label>

                        <select
                            id="priority"
                            name="priority"
                            required
                        >

                            <option
                                value="Low"
                                {{ old('priority', $task->priority) === 'Low' ? 'selected' : '' }}
                            >
                                Low
                            </option>

                            <option
                                value="Medium"
                                {{ old('priority', $task->priority) === 'Medium' ? 'selected' : '' }}
                            >
                                Medium
                            </option>

                            <option
                                value="High"
                                {{ old('priority', $task->priority) === 'High' ? 'selected' : '' }}
                                >
                                High
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Due Date -->
                <div class="form-group">

                    <label for="due_date">
                        Due Date
                    </label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', $task->due_date) }}"
                    >

                </div>


                <!-- Buttons -->
                <div class="form-actions">

                    <a
                        href="{{ route('tasks.index') }}"
                        class="cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="create-task-button"
                    >
                        Update Task
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>