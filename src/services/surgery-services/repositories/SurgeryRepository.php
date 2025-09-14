<?php

namespace Src\Repositories;

use Database;
use Src\Models\Material;
use Src\Models\Surgery;
use Src\Repositories\MaterialRepository;

class SurgeryRepository
{
    private Database $db;
    private MaterialRepository $materialRepository;

    public function __construct(Database $db, MaterialRepository $materialRepository){
        $this->db = $db;
        $this->materialRepository = $materialRepository;
    }

    public function findById(int $id) : ?Surgery { 
        $stmt = $this->db->prepare("SELECT * FROM surgeries WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            return null;
        }

        $materialId = $data['material_id'];

        $materialObject = $this->materialRepository->findById($materialId);

        return new Surgery($data['id'], $data['name'], $data['target'], $data['description'], $materialObject);

    }

    public function findByName(string $name) : ?Surgery { 
        $stmt = $this->db->prepare("SELECT * FROM surgeries WHERE name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            return null;
        }

        $materialId = $data['material_id'];

        $materialObject = $this->materialRepository->findById($materialId);

        return new Surgery($data['id'], $data['name'], $data['target'], $data['description'], $materialObject);
    }

     public function updateSurgery(Surgery $surgery): bool {
        $stmt = $this->db->prepare("UPDATE surgeries SET name = ? , target = ?, description = ?, material_id = ? WHERE id = ?");
        $id = $surgery->getId();
        $name = $surgery->getName();
        $target = $surgery->getTarget();
        $description = $surgery->getDescription();
        $materialId = $surgery->getMaterial()->getId();

        $stmt->bind_param('sssii', $name, $target, $description, $materialId, $id);

        return $stmt->execute();
    }
 
    public function createSurgery(string $name, string $target, string $description, Material $material): int {
        $stmt = $this->db->prepare("INSERT INTO surgeries  (name , target, description, material_id) VALUES (?, ?, ?, ?)");
        $materialId = $material->getId();
        $stmt->bind_param('sssi', $name, $target, $description, $materialId);

        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return 0;
    }
}
?>