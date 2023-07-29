<?php
// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
  // Récupérer les informations du formulaire
  $titre = $_POST['titre'];
  $description = $_POST['description'];

  // Traitement de l'image
  $targetDir = "uploads/"; // Dossier de stockage des images
  $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Vérifier si c'est bien une image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      echo "Le fichier n'est pas une image.";
      $uploadOk = 0;
    }
  }

  // Vérifier si le fichier existe déjà
  if (file_exists($targetFile)) {
    echo "Le fichier existe déjà.";
    $uploadOk = 0;
  }

  // Vérifier la taille de l'image (exemple : limiter à 5 Mo)
  if ($_FILES["photo"]["size"] > 5 * 1024 * 1024) {
    echo "Le fichier est trop volumineux.";
    $uploadOk = 0;
  }

  // Vérifier les formats autorisés (exemple : jpg, jpeg, png, gif)
  $allowedFormats = array("jpg", "jpeg", "png", "gif");
  if (!in_array($imageFileType, $allowedFormats)) {
    echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
  }

  // Si tout est OK, télécharger le fichier
  if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
      echo "Le fichier " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " a été téléchargé avec succès.";
    } else {
      echo "Une erreur est survenue lors du téléchargement du fichier.";
    }
  }

  // Enregistrement des informations dans un fichier JSON
  if ($uploadOk == 1) {
    $data = array(
      "titre" => $titre,
      "description" => $description,
      "photo" => $targetFile // Stockez ici le chemin de l'image téléchargée
    );

    $jsonData = json_encode($data);

    // Enregistrez les données dans un fichier JSON (vous pouvez utiliser une base de données à la place)
    $file = 'data.json';
    if (file_exists($file)) {
      $currentData = json_decode(file_get_contents($file), true);
    } else {
      $currentData = array();
    }

    $currentData[] = $jsonData;
    file_put_contents($file, json_encode($currentData));
  }
}
?>
