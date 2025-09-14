<?php
namespace Src\Services;

use Src\Models\Surgery;
use Src\Repositories\SurgeryRepository;
use Src\Repositories\MaterialRepository;
use InvalidArgumentException;
use RuntimeException;

class SurgeryService
{
    private MaterialRepository $materialRepository;
    private SurgeryRepository $surgeryRepository;

    public function __construct(SurgeryRepository $surgeryRepository, MaterialRepository $materialRepository)
    {
        $this->surgeryRepository = $surgeryRepository;
        $this->materialRepository = $materialRepository;
    }

    public function findSurgeryById(int $id): ?Surgery
    {
        return $this->surgeryRepository->findById($id);
    }

    public function findSurgeryByName(string $name): ?Surgery
    {
        return $this->surgeryRepository->findByName($name);
    }

    public function createSurgery(string $name, string $target, string $description, int $materialId): Surgery
    {
        if (empty($name)) {
            throw new InvalidArgumentException("O nome da cirurgia não pode ser vazio.");
        }

        $material = $this->materialRepository->findById($materialId);
        if (!$material) {
            throw new InvalidArgumentException("Material com ID $materialId não existe.");
        }

        $newSurgeryId = $this->surgeryRepository->createSurgery($name, $target, $description, $material);
        
        if ($newSurgeryId === 0) {
            throw new RuntimeException("Não foi possível criar a cirurgia.");
        }
        
        return $this->surgeryRepository->findById($newSurgeryId);
    }

    public function updateSurgery(int $surgeryId, array $data): Surgery
    {
        $surgery = $this->surgeryRepository->findById($surgeryId);
        if (!$surgery) {
            throw new InvalidArgumentException("Cirurgia com ID $surgeryId não encontrada.");
        }
        
        $actualData = [
            'id' => $surgery->getId(),
            'name' => $surgery->getName(),
            'target' => $surgery->getTarget(),
            'description' => $surgery->getDescription(),
            'material_id' => $surgery->getMaterial()->getId()
        ];

        $upToDateData = array_merge($actualData, $data);

        $material = $this->materialRepository->findById($upToDateData['material_id']);
        if (!$material) {
            throw new InvalidArgumentException("Material com ID {$upToDateData['material_id']} não existe.");
        }
        
        if (empty($upToDateData['name'])) {
            throw new InvalidArgumentException("O nome da cirurgia não pode ser vazio.");
        }
        
        $updatedSurgery = new Surgery(
            $upToDateData['id'],
            $upToDateData['name'],
            $upToDateData['target'],
            $upToDateData['description'],
            $material
        );
       
        $this->surgeryRepository->updateSurgery($updatedSurgery);
        
        return $updatedSurgery;
    }
}