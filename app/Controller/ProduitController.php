<?php

use app\Models\Produit;

class ProduitController {
    private Produit $produitModel;

    public function __construct()
    {
     $this->produitModel = new Produit();
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantite = $_POST['quantite'];

            try {
                $produit = new Produit();
                $produit->setName($name);
                $produit->setPrice($price);
                $produit->setQuantite($quantite);

                $produit->create($produit);

                header('Location: ');
                exit;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function getAll():array
    {
        $produit = $this->produitModel->getAll();
        return $produit;
    }

    public function delete(int $id)
    {
        try {

            $this->produitModel->delete($id);
            header("Location: ");
            exit();
        } catch (Exception $e) {
            echo "eroor" . $e->getMessage();
        }
    }

    public function update()
    {
        if (isset($_POST['update'])) {
            try {

                $id = (int)$_POST['editid'];

                $produit = Produit::find($id);
                $produit->setId($id);
                $produit->setName($_POST['editname']);
                $produit->setPrice($_POST['editprice']);
                $produit->setQuantite($_POST['editquantite']);


                if ($this->produitModel->update($produit)) {
                    header("Location: ");
                    exit();
                }

                throw new Exception("eroror");
            } catch (Exception $e) {
                error_log("Error in update: " . $e->getMessage());
            }
        }
    }

    public function find(int $id)
    {
        return $this->produitModel->find($id);
    }
}