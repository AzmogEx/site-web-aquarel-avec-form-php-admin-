<?php
session_start();

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
  $username = $_POST['Azmog'];
  $password = $_POST['123'];

  // Vérifier les informations de connexion (à personnaliser selon vos besoins)
  $adminUsername = 'votre_nom_utilisateur';
  $adminPassword = 'votre_mot_de_passe';

  if ($username === $adminUsername && $password === $adminPassword) {
    // Informations de connexion correctes, rediriger vers la page admin.php
    $_SESSION['loggedIn'] = true;
    header("Location: admin.php");
    exit();
  } else {
    // Informations de connexion incorrectes, afficher un message d'erreur
    $errorMessage = "Nom d'utilisateur ou mot de passe incorrect.";
  }
}
?>
