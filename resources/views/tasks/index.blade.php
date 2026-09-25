<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Personal Task Manager</title>

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


        <!-- Header -->

        <div class="dashboard-header">

            <div>

                <div class="welcome-text">
                    PERSONAL TASK MANAGER
                </div>

                <h1>
                    My Tasks
                </h1>

                <p class="subtitle">
                    Organize your tasks and keep track of your progress.
                </p>

            </div>


            <a
                href="{{ route('tasks.create') }}"
                class="add-button"
            >
                + Add Task
            </a>

        </div>



        <!-- Success Message -->

        @if(session('success'))

            <div class="success-message">

                {{ session('success') }}

            </div>

        @endif



        <!-- Statistics -->

        <div class="stats-grid">


            <div class="stat-card">

                <div class="stat-icon">
                    📋
                </div>

                <div>

                    <p>
                        Total Tasks
                    </p>

                    <h2>
                        {{ $totalTasks }}
                    </h2>

                </div>

            </div>



            <div class="stat-card">

                <div class="stat-icon">
                    ⏳
                </div>

                <div>

                    <p>
                        Pending
                    </p>

                    <h2>
                        {{ $pendingTasks }}
                    </h2>

                </div>

            </div>



            <div class="stat-card">

                <div class="stat-icon">
                    ✓
                </div>

                <div>

                    <p>
                        Completed
                    </p>

                    <h2>
                        {{ $completedTasks }}
                    </h2>

                </div>

            </div>


        </div>



        <!-- Search and Controls -->

        <div class="search-section">


            <!-- Live Search -->

            <div class="search-form">

                <div class="search-input-wrapper">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        id="taskSearch"
                        placeholder="Search tasks..."
                        autocomplete="off"
                    >

                </div>

            </div>



            <div class="task-controls">


                <!-- Filter -->

                <div class="filter-group">

                    <span class="control-label">
                        Filter:
                    </span>


                    <a
                        href="{{ route('tasks.index', ['sort' => $sort]) }}"
                        class="filter-button {{ !$status ? 'active' : '' }}"
                    >
                        All
                    </a>


                    <a
                        href="{{ route('tasks.index', ['status' => 'Pending', 'sort' => $sort]) }}"
                        class="filter-button {{ $status === 'Pending' ? 'active' : '' }}"
                    >
                        Pending
                    </a>


                    <a
                        href="{{ route('tasks.index', ['status' => 'Completed', 'sort' => $sort]) }}"
                        class="filter-button {{ $status === 'Completed' ? 'active' : '' }}"
                    >
                        Completed
                    </a>

                </div>



                <!-- Sort -->

                <div class="filter-group">

                    <span class="control-label">
                        Sort:
                    </span>


                    <a
                        href="{{ route('tasks.index', ['status' => $status]) }}"
                        class="filter-button {{ !$sort || $sort === 'newest' ? 'active' : '' }}"
                    >
                        Newest
                    </a>


                    <a
                        href="{{ route('tasks.index', ['status' => $status, 'sort' => 'oldest']) }}"
                        class="filter-button {{ $sort === 'oldest' ? 'active' : '' }}"
                    >
                        Oldest
                    </a>


                    <a
                        href="{{ route('tasks.index', ['status' => $status, 'sort' => 'due_date']) }}"
                        class="filter-button {{ $sort === 'due_date' ? 'active' : '' }}"
                    >
                        Due Date
                    </a>

                </div>

            </div>

        </div>



        <!-- Section Heading -->

        <div class="section-heading">

            <div>

                <div class="section-label">
                    TASK LIST
                </div>

                <h2>
                    Your Tasks
                </h2>

            </div>


            <div class="task-counter">

                {{ $tasks->count() }} task(s)

            </div>

        </div>



        <!-- Tasks -->

        @if($tasks->count() > 0)


            <div
                class="tasks-container"
                id="tasksContainer"
            >


                @foreach($tasks as $index => $task)


                    <div
                        class="task-card"

                        data-task-name="{{ strtolower($task->task_name) }}"

                        data-task-description="{{ strtolower($task->description ?? '') }}"
                    >


                        <!-- Task Header -->

                        <div class="task-header">


                            <div class="task-title-area">


                                <div class="task-number">

                                    {{ $index + 1 }}

                                </div>


                                <h2>

                                    {{ strtoupper($task->task_name) }}

                                </h2>


                            </div>



                            <div class="status-area">

                                <span
                                    class="status {{ strtolower($task->status) }}"
                                >

                                    {{ $task->status }}

                                </span>

                            </div>


                        </div>



                        <!-- Description -->

                        <div class="task-description">

                            <strong>
                                Description:
                            </strong>

                            {{ $task->description ?: 'No description provided.' }}

                        </div>



                        <!-- Priority -->

                        <div class="task-priority">

                            <strong>
                                Priority:
                            </strong>


                            <span
                                class="priority {{ strtolower($task->priority) }}"
                            >

                                {{ $task->priority }}

                            </span>

                        </div>



                        <!-- Due Date -->

                        <div class="due-date">

                            <strong>
                                Due Date:
                            </strong>


                            @if($task->due_date)


                                <span>

                                    {{ \Carbon\Carbon::parse($task->due_date)->format('F d, Y') }}

                                </span>



                                @if($task->status === 'Completed')


                                    <span class="completed-date">

                                        ✓ Completed

                                    </span>


                                @elseif(\Carbon\Carbon::parse($task->due_date)->isPast())


                                    <span class="overdue">

                                        ⚠ Overdue

                                    </span>


                                @else


                                    <span class="upcoming">

                                        Upcoming

                                    </span>


                                @endif


                            @else


                                <span>

                                    No due date

                                </span>


                            @endif

                        </div>



                        <!-- Actions -->

                        <div class="actions">


                            <!-- Edit -->

                            <a
                                href="{{ route('tasks.edit', $task) }}"
                                class="edit-button"
                            >
                                Edit
                            </a>



                            <!-- Delete -->

                            <form
                                action="{{ route('tasks.destroy', $task) }}"
                                method="POST"
                                class="delete-form"
                            >

                                @csrf

                                @method('DELETE')


                                <button
                                    type="button"
                                    class="delete-button"
                                    onclick="openDeleteModal(this)"
                                >
                                    Delete
                                </button>

                            </form>


                        </div>


                    </div>


                @endforeach


            </div>


        @else


            <!-- Empty State -->

            <div class="empty-state">


                <div class="empty-icon">
                    ✓
                </div>


                <h2>
                    No Tasks Found
                </h2>


                <p>
                    You don't have any tasks yet.
                </p>


                <a
                    href="{{ route('tasks.create') }}"
                    class="add-button"
                >
                    + Add Your First Task
                </a>


            </div>


        @endif


    </div>



    <!-- Delete Confirmation Modal -->

    <div
        class="delete-modal"
        id="deleteModal"
    >


        <div class="delete-modal-box">


            <div class="delete-modal-icon">
                ⚠
            </div>


            <h2>
                Delete Task?
            </h2>


            <p>
                Are you sure you want to delete this task?
                This action cannot be undone.
            </p>


            <div class="delete-modal-actions">


                <button
                    type="button"
                    class="cancel-delete-button"
                    onclick="closeDeleteModal()"
                >
                    Cancel
                </button>


                <button
                    type="button"
                    class="confirm-delete-button"
                    onclick="confirmDelete()"
                >
                    Delete
                </button>


            </div>


        </div>


    </div>



    <!-- JavaScript -->

    <script>


        // =========================
        // LIVE SEARCH
        // =========================

        const searchInput =
            document.getElementById('taskSearch');

        const taskCards =
            document.querySelectorAll('.task-card');


        searchInput.addEventListener(
            'input',
            function () {


                const searchValue =
                    this.value.toLowerCase().trim();


                taskCards.forEach(
                    function (card) {


                        const taskName =
                            card.dataset.taskName;


                        const taskDescription =
                            card.dataset.taskDescription;


                        if (
                            taskName.includes(searchValue) ||
                            taskDescription.includes(searchValue)
                        ) {

                            card.style.display = '';

                        } else {

                            card.style.display = 'none';

                        }

                    }
                );

            }
        );



        // =========================
        // DELETE MODAL
        // =========================

        let deleteForm = null;


        function openDeleteModal(button) {


            deleteForm =
                button.closest('form');


            document
                .getElementById('deleteModal')
                .classList.add('show');

        }



        function closeDeleteModal() {


            deleteForm = null;


            document
                .getElementById('deleteModal')
                .classList.remove('show');

        }



        function confirmDelete() {


            if (deleteForm) {

                deleteForm.submit();

            }

        }



        // Close modal when clicking outside

        document
            .getElementById('deleteModal')
            .addEventListener(
                'click',
                function (event) {


                    if (event.target === this) {

                        closeDeleteModal();

                    }

                }
            );


    </script>


</body>

</html>