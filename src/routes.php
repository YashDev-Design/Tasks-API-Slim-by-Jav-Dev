<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// GET all tasks
$app->get('/tasks', function (Request $request, Response $response) use ($pdo) {
    $stmt = $pdo->query("SELECT * FROM tasks");
    $tasks = $stmt->fetchAll();
    $response->getBody()->write(json_encode($tasks));
    return $response->withHeader('Content-Type', 'application/json');
});

// POST create task
$app->post('/tasks', function (Request $request, Response $response) use ($pdo) {
    $data = $request->getParsedBody();
    $sql = "INSERT INTO tasks (title, description, status, priority, due_date)
            VALUES (:title, :description, :status, :priority, :due_date)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $response->getBody()->write(json_encode(['message' => 'Task created successfully']));
    return $response->withHeader('Content-Type', 'application/json');
});

// PUT update task
$app->put('/tasks/{id}', function (Request $request, Response $response, $args) use ($pdo) {
    $data = $request->getParsedBody();
    $sql = "UPDATE tasks SET title=:title, description=:description, status=:status, priority=:priority, due_date=:due_date WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $data['id'] = $args['id'];
    $stmt->execute($data);
    $response->getBody()->write(json_encode(['message' => 'Task updated successfully']));
    return $response->withHeader('Content-Type', 'application/json');
});

// DELETE task
$app->delete('/tasks/{id}', function (Request $request, Response $response, $args) use ($pdo) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$args['id']]);
    $response->getBody()->write(json_encode(['message' => 'Task deleted successfully']));
    return $response->withHeader('Content-Type', 'application/json');
});

// PATCH - Toggle Task Status
$app->patch('/tasks/{id}/toggle', function (Request $request, Response $response, $args) use ($pdo) {
    $id = $args['id'];

    // Fetch current status
    $stmt = $pdo->prepare("SELECT status FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    if (!$task) {
        $response->getBody()->write(json_encode(['error' => 'Task not found']));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }

    // Toggle status
    $newStatus = $task['status'] === 'pending' ? 'completed' : 'pending';
    $update = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
    $update->execute([$newStatus, $id]);

    $response->getBody()->write(json_encode(['message' => "Task status changed to $newStatus"]));
    return $response->withHeader('Content-Type', 'application/json');
});