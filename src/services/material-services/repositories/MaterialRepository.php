<?php 
namespace Src\Repositories;

use Src\Models\Material;
use mysqli;


class MaterialRepository
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function findById(int $id) : ?Material {
        $stmt = $this->db->prepare("SELECT * FROM materials WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            return null;
        }

        return new Material($data['id'], $data['name'], $data['quantity'], $data['position'], $data['support']);

    }

    public function findByName(string $name) : ?Material {
        $stmt = $this->db->prepare("SELECT * FROM materials WHERE name = ?");
        $stmt->bind_param('s', $name);
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            return null;
        }

        return new Material($data['id'], $data['name'], $data['quantity'], $data['position'], $data['support']);

    }

    public function updateMaterial(Material $material)  { // TODO: Must return bool and finish those functions
        $stmt = $this->db->prepare("UPDATE materials SET name = ? , quantity = ?, position = ?, ");
        

    }


}
?>