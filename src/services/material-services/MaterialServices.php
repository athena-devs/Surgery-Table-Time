<?php
namespace Src\Services;

use Src\Models\Material;
use Src\Repositories\MaterialRepository;
use InvalidArgumentException;

class MaterialService
{
    private MaterialRepository $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function findMaterialById(int $id): ?Material
    {
        return $this->materialRepository->findById($id);
    }

    public function findMaterialByName(string $name): ?Material
    {
        return $this->materialRepository->findByName($name);
    }

    public function createMaterial(string $name, int $quantity, string $position, array $support): Material
    {
        if (empty($name)) {
            throw new InvalidArgumentException("O nome do material não pode ser vazio.");
        }
        if ($quantity < 0) {
            throw new InvalidArgumentException("A quantidade não pode ser negativa.");
        }

        $newMaterialId = $this->materialRepository->createMaterial($name, $quantity, $position, $support);
        
        if ($newMaterialId === 0) {
            throw new \RuntimeException("Não foi possível criar o material.");
        }
        
        return $this->materialRepository->findById($newMaterialId);
    }

    public function updateMaterial(int $materialId, array $data): Material
    {
        $material = $this->materialRepository->findById($materialId);
        if (!$material) {
            throw new InvalidArgumentException("Material com ID $materialId não encontrado.");
        }
        $actualData = [
            'id' => $material->getId(),
            'name' => $material->getName(),
            'quantity' => $material->getQuantity(),
            'position' => $material->getPosition(),
            'support' => $material->getSupport()
        ];

        $upToDateData = array_merge($actualData, $data);

        if (empty($upToDateData['name'])) {
            throw new InvalidArgumentException("O nome do material não pode ser vazio.");
        }
        if ($upToDateData['quantity'] < 0) {
            throw new InvalidArgumentException("A quantidade não pode ser negativa.");
        }

        if (empty($upToDateData['position'])) {
            throw new InvalidArgumentException("A posição/tempo círurgico não pode nula.");
        }
    
        if (empty($upToDateData['support'])) {
            throw new InvalidArgumentException("O suporte/auxiliares não pode nulo.");
        }
        
        $updatedMaterial = new Material(
            $upToDateData['id'],
            $upToDateData['name'],
            $upToDateData['quantity'],
            $upToDateData['position'],
            $upToDateData['support']
        );
       
        $this->materialRepository->updateMaterial($updatedMaterial);
        
        return $updatedMaterial;
    }
}