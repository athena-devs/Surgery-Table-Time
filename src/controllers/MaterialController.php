<?php 

namespace Src\Controllers;

use Database;

use Src\Services\MaterialService;
use Src\Repositories\MaterialRepository;
use InvalidArgumentException;

class MaterialController
{
    private MaterialService $materialService;

    public function __construct()
    {
        $db = new Database();
        $materialRepository = new MaterialRepository($db);
        $this->materialService = new MaterialService($materialRepository);
    }

    public function show(int $id): void
    {
        header('Content-Type: application/json');
        $material = $this->materialService->findMaterialById($id);

        if ($material) {
            echo json_encode([
                'id' => $material->getId(),
                'name' => $material->getName(),
                'quantity' => $material->getQuantity(),
                'position' => $material->getPosition(),
                'support' => $material->getSupport()
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Material não encontrado.']);
        }
    }

    public function store(): void
    {
        header('Content-Type: application/json');
        $data = $_POST;

        try {
            $newMaterial = $this->materialService->createMaterial(
                $data['name'],
                (int)$data['quantity'],
                $data['position'],
                json_decode($data['support'], true)
            );
            
            http_response_code(201); 
            echo json_encode(['message' => 'Material criado com sucesso!', 'id' => $newMaterial->getId()]);
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
 public function update(int $id): void
    {
        header('Content-Type: application/json');
        parse_str(file_get_contents("php://input"), $data);

        try {
            $updatedMaterial = $this->materialService->updateMaterial($id, $data);
            echo json_encode(['message' => 'Material atualizado com sucesso!', 'name' => $updatedMaterial->getName()]);
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
?>