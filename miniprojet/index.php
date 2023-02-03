<?php

require './logic/router.php';
/*Votre fichier index.php soit vérifier si $_GET["route"] existe, si oui il doit appeler la fonction
checkRoute en lui passant la valeur
de $_GET["route"] comme paramètre,
sinon il doit appeler checkRoute en lui passant en paramètre une chaine vide.*/


if(isset($_GET['route'])) {
    $route = $_GET['route'];

    checkRoute($route);
}

else {
    checkRoute("");
}


// Condition pour l'inscription


if(isset($_POST['email']) && !empty($_POST['email'])
&& isset($_POST['password']) && !empty($_POST['password'])
&& isset($_POST['confirm-pwd']) && !empty($_POST['confirm-pwd'])
&& isset($_POST['firstName']) && !empty($_POST['firstName'])
&& isset($_POST['lastName']) && !empty($_POST['lastName']))
{
    if($_POST['password'] === $_POST['confirm-pwd']) {
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newUserToSave = new User($_POST['firstName'], $_POST['lastName'], $_POST['email'], $pass);
    saveUser($newUserToSave);
    }
    else
    {
        $error = "Les mots de passe ne correspondent pas !";
    }
}
else if(isset($_POST['email']) && empty($_POST['email'])) {
    $error = "Veuillez rentrer un email";
}

else if(isset($_POST['firstName']) && empty($_POST['firstName'])) {
    $error = "Veuillez rentrer un prénom !";
}

else if(isset($_POST['lastName']) && empty($_POST['lastName'])) {
    $error = "Veuillez rentrer un nom !";
}

// Condition pour le connexion


if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']))
{

    $userToCheck = loadUser($_POST['email']);

    $checkPass = password_verify($userToCheck->getPassword() , $_POST['password']);

    if($checkPass === true)
    {
        require './pages/account.php';
    }

    else
    {
        $error = "les informations de connexion sont incorrectes !";
    }

}
else
{
    $error = "Les informations de connexion sont incorrectes ! ";
}

?>



<?php

/*Test de la class User :
$user = new User('John', 'Doe', 'johndoe@example.com', 'secret');

// Test if an instance of User can be created
if ($user instanceof User) {
    echo "Success: An instance of User was created." . PHP_EOL;
} else {
    echo "Error: Failed to create an instance of User." . PHP_EOL;
}

// Test if the id is null
if ($user->getId() === null) {
    echo "Success: The user's id is null." . PHP_EOL;
} else {
    echo "Error: The user's id is not null." . PHP_EOL;
}

// Test if the first name can be retrieved
if ($user->getFirstName() === 'John') {
    echo "Success: The user's first name was retrieved correctly." . PHP_EOL;
} else {
    echo "Error: The user's first name was not retrieved correctly." . PHP_EOL;
}

// Test if the last name can be retrieved
if ($user->getLastName() === 'Doe') {
    echo "Success: The user's last name was retrieved correctly." . PHP_EOL;
} else {
    echo "Error: The user's last name was not retrieved correctly." . PHP_EOL;
}

// Test if the email can be retrieved
if ($user->getEmail() === 'johndoe@example.com') {
    echo "Success: The user's email was retrieved correctly." . PHP_EOL;
} else {
    echo "Error: The user's email was not retrieved correctly." . PHP_EOL;
}

// Test if the password can be retrieved
if ($user->getPassword() === 'secret') {
    echo "Success: The user's password was retrieved correctly." . PHP_EOL;
} else {
    echo "Error: The user's password was not retrieved correctly." . PHP_EOL;
}

// Test if the id can be set
$user->setId(1);
if ($user->getId() === 1) {
    echo "Success: The user's id was set correctly." . PHP_EOL;
} else {
    echo "Error: The user's id was not set correctly." . PHP_EOL;
}

// Test if the first name can be set
$user->setFirstName('Jane');
if ($user->getFirstName() === 'Jane') {
    echo "Success: The user's first name was set correctly." . PHP_EOL;
} else {
    echo "Error: The user's first name was not set correctly." . PHP_EOL;
}

// Test if the last name can be set
$user->setLastName('Smith');
if ($user->getLastName() === 'Smith') {
    echo "Success: The user's last name was set correctly." . PHP_EOL;
} else {
    echo "Error: The user's last name was not set correctly." . PHP_EOL;
}

// Test if the email can be set
$user->setEmail('janesmith@example.com');
 */;

?>
