<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Получить все задачи
    public function index()
    {
        return Task::all();
    }

    // Создать новую задачу
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'executor' => 'required|string|max:255',
            'estimated_hours' => 'required|integer',
            'reviewer' => 'required|string|max:255',
            'status' => 'required|in:backlog,in_progress,waiting,review,done',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // Получить задачу по ID
    public function show($id)
    {
        return Task::find($id);
    }

    // Обновить задачу
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'executor' => 'sometimes|required|string|max:255',
            'estimated_hours' => 'sometimes|required|integer',
            'reviewer' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:backlog,in_progress,waiting,review,done',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task, 200);
    }

    // Удалить задачу
    public function destroy($id)
    {
        Task::destroy($id);
        return response()->json(null, 204);
    }

    public function seedTasks()
    {
        Task::truncate();

        Task::create([
            'title' => 'Создать макет интерфейса',
            'description' => 'Разработать макет главной страницы приложения.',
            'executor' => 'Иван Иванов',
            'estimated_hours' => 5,
            'reviewer' => 'Петр Петров',
            'status' => 'backlog',
        ]);

        Task::create([
            'title' => 'Настроить API',
            'description' => 'Создать маршруты и контроллеры для работы с задачами.',
            'executor' => 'Анна Смирнова',
            'estimated_hours' => 8,
            'reviewer' => 'Сергей Сергеев',
            'status' => 'in_progress',
        ]);

        Task::create([
            'title' => 'Написать документацию',
            'description' => 'Документировать API и пользовательский интерфейс.',
            'executor' => 'Ольга Кузнецова',
            'estimated_hours' => 3,
            'reviewer' => 'Дмитрий Дмитриев',
            'status' => 'waiting',
        ]);

        Task::create([
            'title' => 'Провести ревью кода',
            'description' => 'Проверить код на соответствие стандартам.',
            'executor' => 'Александр Александров',
            'estimated_hours' => 2,
            'reviewer' => 'Иван Иванов',
            'status' => 'review',
        ]);

        Task::create([
            'title' => 'Подготовить к релизу',
            'description' => 'Собрать все изменения и подготовить к релизу.',
            'executor' => 'Мария Петрова',
            'estimated_hours' => 4,
            'reviewer' => 'Анна Смирнова',
            'status' => 'done',
        ]);

        return response()->json(['message' => 'Тестовые задачи добавлены'], 201);
    }
}
