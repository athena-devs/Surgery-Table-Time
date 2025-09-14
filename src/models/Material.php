<?php
namespace Src\Models;

class Material
{
    private ?int $id;
    private string $name;
    private int $quantity;
    private string $position;
    private array $support;
    

    public function __construct(?int $id, string $name, int $quantity, string $position, array $support)  {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->position = $position;
        $this->support = $support;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getQuantity(): int {
            return $this->quantity;
    }

    public function getPosition(): string {
        return $this->position;
    }

    public function getSupport(): array {
        return $this->support;
    }

}
?>