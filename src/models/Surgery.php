<?php
namespace Src\Models;


class Surgery
{
    private ?int $id;
    private string $name;
    private string $target;
    private string $description;
    private Material $material;

    public function __construct(?int $id, string $name, string $target, string $description, Material $material)  {
        $this->id = $id;
        $this->name = $name;
        $this->target = $target;
        $this->description = $description;
        $this->material = $material;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getTarget(): string {
        return $this->target;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getMaterial() : Material {
        return $this->material;
    }
}

?>