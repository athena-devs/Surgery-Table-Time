<?php
namespace Src\Controllers;

use Database;
use Src\Services\SurgeryService;
use Src\Repositories\SurgeryRepository;
use Src\Repositories\MaterialRepository;
use InvalidArgumentException;

class SurgeryController
{
    private SurgeryService $surgeryService;

    public function __construct()
    {
        $db = new Database();
        $materialRepository = new MaterialRepository($db);
        $surgeryRepository = new SurgeryRepository($db, $materialRepository);
        $this->surgeryService = new SurgeryService($surgeryRepository, $materialRepository);
    }

    public function show(int $id): void
    {
        header('Content-Type: application/json');
        $surgery = $this->surgeryService->findSurgeryById($id);

        if ($surgery) {
            echo json_encode([
                'id' => $surgery->getId(),
                'name' => $surgery->getName(),
                'target' => $surgery->getTarget(),
                'description' => $surgery->getDescription(),
                'material' => [ // Objeto aninhado
                    'id' => $surgery->getMaterial()->getId(),
                    'name' => $surgery->getMaterial()->getName()
                ]
            ]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Cirurgia não encontrada.']);
        }
    }

    public function store(): void
    {
        header('Content-Type: application/json');
        $data = $_POST;

        try {
            $newSurgery = $this->surgeryService->createSurgery(
                $data['name'],
                $data['target'],
                $data['description'],
                (int)$data['material_id']
            );
            
            http_response_code(201);
            echo json_encode(['message' => 'Cirurgia criada com sucesso!', 'id' => $newSurgery->getId()]);
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
            $updatedSurgery = $this->surgeryService->updateSurgery($id, $data);
            echo json_encode(['message' => 'Cirurgia atualizado com sucesso!', 'name' => $updatedSurgery->getName()]);
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
}