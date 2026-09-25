<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Task - Personal Task Manager</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

        <!-- Header -->
        <!-- Header -->
<div class="dashboard-header">

    <div>

        <div class="welcome-text">
            PERSONAL TASK MANAGER
        </div>

        <h1>Add New Task</h1>

        <p class="subtitle">
            Create a new task and keep track of your progress.
        </p>

    </div>

</div>


        <!-- Form Card -->
        <div class="form-card">

            <form
                action="{{ route('tasks.store') }}"
                method="POST"
            >

                @csrf


                <!-- Task Name -->
                <div class="form-group">

                    <label for="task_name">
                        Task Name
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name') }}"
                        placeholder="Enter task name"
                        required
                        autocomplete="off"
                    >

                    @error('task_name')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <!-- Description -->
                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Enter task description"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <!-- Status and Priority -->
                <div class="form-row">

                    <!-- Status -->
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
                                {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="Completed"
                                {{ old('status') === 'Completed' ? 'selected' : '' }}
                            >
                                Completed
                            </option>

                        </select>

                        @error('status')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    <!-- Priority -->
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
                                {{ old('priority') === 'Low' ? 'selected' : '' }}
                            >
                                Low
                            </option>

                            <option
                                value="Medium"
                                {{ old('priority', 'Medium') === 'Medium' ? 'selected' : '' }}
                            >
                                Medium
                            </option>

                            <option
                                value="High"
                                {{ old('priority') === 'High' ? 'selected' : '' }}
                            >
                                High
                            </option>

                        </select>

                        @error('priority')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror

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
                        value="{{ old('due_date') }}"
                    >

                    @error('due_date')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <!-- Form Actions -->
                <div class="form-actions">

                    <a
                        href="{{ route('tasks.index') }}"
                        class="cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="save-button"
                    >
                        + Create Task
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- Task Name Behavior -->
    <script>

        const taskName = document.getElementById('task_name');
        const description = document.getElementById('description');


        // Automatically convert task name to uppercase
        taskName.addEventListener('input', function () {

            this.value = this.value.toUpperCase();

        });


        // Press Enter to move to Description
        // instead of submitting the form
        taskName.addEventListener('keydown', function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                description.focus();

            }

        });

    </script>

</body>
</html>