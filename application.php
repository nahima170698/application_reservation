<?php
class MaConnexion
{
  /*
    private $nomBaseDeDonnees = "";
    private $motDepasse = "";
    private $nomUtilisateur = "root";
    private $hote = "localhost";
    */
  private $nomBaseDeDonnees;
  private $motDepasse;
  private $nomUtilisateur;
  private $hote;
  private $connexionPDO;



  public function __construct($nomBaseDeDonnees, $motDepasse, $nomUtilisateur, $hote)
  {

    $this->nomBaseDeDonnees = $nomBaseDeDonnees;
    $this->motDepasse = $motDepasse;
    $this->nomUtilisateur = $nomUtilisateur;
    $this->hote = $hote;

    

    try {
      $dsn = "mysql:host=$this->hote;dbname=$this->nomBaseDeDonnees;charset=utf8mb4";
      $this->connexionPDO = new PDO($dsn, $this->nomUtilisateur, $this->motDepasse);
      $this->connexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "ui";
    } catch (PDOException $e) {
      echo "Erreur : " . $e->getMessage();
    }
  }

  public function select($table, $column)
  {
    try {
      $requete = "SELECT $column from $table";
      $resultat = $this->connexionPDO->query($requete);
      $resultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    } catch (PDOException $e) {
      echo "Erreur : " . $e->getMessage();
    }
  }
  
  public function tableau($client, $salle, $date)
  {
    $requete = ("INSERT INTO id_appreservation (client, salle, date) VALUES (?,?,?)");
    $stmt = $this->connexionPDO->prepare($requete);
    $stmt->execute([$client, $salle, $date]);
  }
  public function insertionProduit_Secure($nom, $prix, $description)
  {
    try {
      $requete = "INSERT INTO produit (nom, prix, description) VALUES (:nom, :prix, :description)";
      $requete_preparee = $this->connexionPDO->prepare($requete);

      $requete_preparee->bindParam(':nom', $nom, PDO::PARAM_STR, 25);
      $requete_preparee->bindParam(':prix', $prix, PDO::PARAM_STR, 25);
      $requete_preparee->bindParam(':description', $description, PDO::PARAM_STR, 25);

      $requete_preparee->execute();
      return "insertion reussie";
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  public function miseAJourProduit_Secure($nom, $prix, $description, $id)
  {
    try {
      $requete = "UPDATE Produit SET Nom  = ?, Prix  = ?, Description = ? WHERE ID_Produit = ?";
      $requete_preparee = $this->connexionPDO->prepare($requete);
      
      $requete_preparee->bindValue(1, $nom, PDO::PARAM_STR);
      $requete_preparee->bindValue(2, $prix, PDO::PARAM_INT);
      $requete_preparee->bindValue(3, $description, PDO::PARAM_STR);
      $requete_preparee->bindValue(4, $id, PDO::PARAM_INT);
      
      $requete_preparee->execute();
      return "mise à jour réussie";
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  
  public function miseAJourProduit_Client($Nom, $Adresse, $AdresseEmail, $id_Client)
  {
    try {
      $requete = "UPDATE client SET Nom  = ?, Adresse  = ?, AdresseEmail = ? WHERE id_Client = ?";
      $requete_preparee = $this->connexionPDO->prepare($requete);
      
      $requete_preparee->bindValue(1, $Nom, PDO::PARAM_STR);
      $requete_preparee->bindValue(2, $Adresse, PDO::PARAM_STR);
      $requete_preparee->bindValue(3, $AdresseEmail, PDO::PARAM_STR);
      $requete_preparee->bindValue(4, $id_Client, PDO::PARAM_INT);
      
      $requete_preparee->execute();
      return "mise à jour réussie";
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}