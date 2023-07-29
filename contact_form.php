<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure l'autoloader de PHPMailer
require 'chemin_vers/PHPMailer/src/Exception.php';
require 'chemin_vers/PHPMailer/src/PHPMailer.php';
require 'chemin_vers/PHPMailer/src/SMTP.php';

// Le reste du code du fichier contact_form.php continue à partir d'ici...

// Créer une nouvelle instance de PHPMailer
$mail = new PHPMailer();

// Configurer le serveur SMTP
$mail->isSMTP();
$mail->Host = 'localhost'; // Modifier pour le nom de votre serveur SMTP
$mail->Port = 25; // Modifier pour le port SMTP de votre serveur
$mail->SMTPAuth = false; // Modifier en true si votre serveur SMTP nécessite une authentification

// Définir l'adresse de l'expéditeur et du destinataire
$mail->setFrom($email, $name);
$mail->addAddress('votre@email.com'); // Remplacez par votre adresse e-mail

// Définir le sujet et le contenu de l'e-mail
$mail->Subject = 'Nouveau message de ' . $name;
$mail->Body = "Vous avez reçu un nouveau message depuis le formulaire de contact de votre site web.\n\n";
$mail->Body .= "Nom: " . $name . "\n";
$mail->Body .= "E-mail: " . $email . "\n";
$mail->Body .= "Message:\n" . $message;

// Envoyer l'e-mail
if ($mail->send()) {
    // Redirection vers la page de confirmation en cas de succès
    header("Location: confirmation.html");
    exit();
} else {
    // Affichage d'une erreur en cas d'échec de l'envoi
    echo "Une erreur est survenue lors de l'envoi du message. Veuillez réessayer plus tard.";
}
?>
