<?php

namespace app\Models;

use App\Config\Database;
use PDO;
use PDOException;

// use app\Models\DatabaseConnection;

class Produit {

    private int $id;
    private string $name;
    private string $price;
    private string $quantite;

    public function __construct()
    {
        
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getPrice(): string
    {
        return $this->price;
    }
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }
    public function getQuantite(): string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): void
    {
        $this->quantite = $quantite;
    }

    public function create(Produit $produit)
    {
        $query = "INSERT INTO users (name, price, quantite) VALUES (:name, :price, :quantite)";

        $stmt = Database::getInstance()->getPdo()->prepare($query);
        $stmt->execute([
            'name'    => $produit->getName(),
            'price'    => $produit->getPrice(),
            'quantite'    => $produit->getQuantite(),
        ]);

        $produit->setId(Database::getInstance()->getPdo()->lastInsertId());

        return $produit;
    }


    public function getAll(): array
    {
        try {
            $query = "SELECT * FROM produits";
            $stmt = Database::getInstance()->getPdo()->prepare($query);
            $stmt->execute();

            $product = [];
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $product = new Produit();
                $product->setId($row->id);
                $product->setName($row->name);
                $product->setPrice($row->price);
                $product->setQuantite($row->quantite);
                $products[] = $product;
            }
            
            return $products;
        } catch (PDOException $e) {
            error_log("Database error:" . $e->getMessage());
            return [];
        }
    }

    public function delete(int $id)
    {
        try {
            $query = "DELETE FROM produits WHERE id = :id";

            $stmt = Database::getInstance()->getPdo()->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("eroro delete" . $e->getMessage());
            return false;
        }
    }

    public function update(Produit $product): bool
    {
        try {
            $query = "UPDATE produits SET 
            name = :name,
            price = :price,
            quantite = :quantite,
            WHERE id = :id";

            $stmt = Database::getInstance()->getPdo()->prepare($query);
            return $stmt->execute([
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'quantite' => $product->getQuantite(),
                'id' => $product->getId()
            ]);
        } catch (PDOException $e) {
            error_log("Error updating : " . $e->getMessage());
            return false;
        }
    }

    public static function find(int $id)
    {
        $query = "SELECT * FROM produits WHERE id = " . $id;

        $statement = Database::getInstance()->getPdo()->prepare($query);
        $statement->execute();

        return $statement->fetchObject(Produit::class);
    }


}
