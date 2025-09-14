<?php 
namespace Src\Repositories;

use Database;
use Src\Models\Material;


class MaterialRepository
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findById(int $id) : ?Material {
        $stmt = $this->db->prepare("SELECT * FROM materials WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            return null;
        }

        $supportArray = json_decode($data['support'], true);        

        return new Material($data['id'], $data['name'], $data['quantity'], $data['position'], $supportArray);

    }

    public function findByName(string $name) : ?Material {
        $stmt = $this->db->prepare("SELECT * FROM materials WHERE name = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            return null;
        }

        $supportArray = json_decode($data['support'], true);        

        return new Material($data['id'], $data['name'], $data['quantity'], $data['position'], $supportArray);

    }

    public function updateMaterial(Material $material): bool {
        $stmt = $this->db->prepare("UPDATE materials SET name = ? , quantity = ?, position = ?, support = ? WHERE id = ?");
        $id = $material->getId();
        $name = $material->getName();
        $quantity = $material->getQuantity();
        $position = $material->getPosition();

        $supportJson = json_encode($material->getSupport());
    
        $stmt->bind_param('sissi', $name, $quantity, $position, $supportJson, $id);

        return $stmt->execute();
    }
    public function createMaterial(string $name, int $quantity, string $position, array $support): int {
        $stmt = $this->db->prepare("INSERT INTO materials  (name , quantity, position, support) VALUES (?, ?, ?, ?)");
        $supportJson = json_encode($support);
        $stmt->bind_param('siss', $name, $quantity, $position, $supportJson);
   
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return 0;
    }

}
?>