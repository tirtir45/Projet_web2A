<?php
require_once(__DIR__ . '/../connect.php');
require_once(__DIR__ . '/../Models/User.php');

class UserController
{
    // Récupérer la liste des utilisateurs
    public function listUsers()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
// Récupérer un utilisateur par son ID

public function getUserById($id)
{
   $sql = "SELECT * FROM user WHERE id = :id";
   $db = config::getConnexion();
   $row = $db->prepare($sql);
   $row->bindValue(':id', $id);
   try {
       $row->execute(); 
       return $row->fetch(PDO::FETCH_ASSOC); 
   } catch (Exception $e) {
       die('Error:' . $e->getMessage());
   }
}

    // Supprimer un utilisateur par son ID
    public function deleteUser($id_user)
    {
        $sql = "DELETE FROM user WHERE id = :id_user";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_user', $id_user);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Ajouter un nouvel utilisateur
    public function addUser($user)
    {
        $sql = "INSERT INTO user (firstname, lastname, gender, email, password, role) 
                VALUES (:firstname, :lastname, :gender, :email, :password, :role)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'gender' => $user->getGender(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Mettre à jour les informations d'un utilisateur
    public function updateUser($user, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE user SET 
                    firstname = :firstname, 
                    lastname = :lastname, 
                    gender = :gender, 
                    email = :email, 
                    password = :password, 
                    role = :role
                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'gender' => $user->getGender(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole()
            ]);
            echo $query->rowCount() . " enregistrements mis à jour avec succès.<br>";
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    // Afficher les détails d'un utilisateur par son ID
    public function showUser($id_user)
    {
        $sql = "SELECT * FROM user WHERE id = :id_user";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_user' => $id_user]);
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function register($user)
    {
        // Vérifier si l'utilisateur existe déjà
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->execute(['email' => $user->getEmail()]);
        
        if ($query->rowCount() > 0) {
            return "Email déjà utilisé !";
        }
    
        // Définir le rôle par défaut 'user'
        $role = 'user';
    
        // Insertion de l'utilisateur avec le rôle par défaut
        $sql = "INSERT INTO user (firstname, lastname, gender, email, password, role) 
                VALUES (:firstname, :lastname, :gender, :email, :password, :role)";
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'gender' => $user->getGender(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $role 
            ]);
            return "Inscription réussie !";
        } catch (Exception $e) {
            return 'Erreur : ' . $e->getMessage();
        }
    }
    

    public function login($email, $password)
    {
        // Rechercher l'utilisateur par son email
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->execute(['email' => $email]);
        $user = $query->fetch();
    
        if ($user) {
            if ($password == $user['password']) {
                return $user; 
            } else {
                return "Invalid password!";  
            }
        } else {
            return "User not found!";  
        }
    }
   // Mettre à jour le profil de l'utilisateur
public function updateProfile($user_id, $firstname, $lastname, $email, $role, $password = null)
{
    $db = config::getConnexion();

    // Si un nouveau mot de passe est fourni, le hacher
    if ($password) {
        $sql = "UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, password = :password WHERE id = :id_user";
        $params = [
            'id_user' => $user_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
        ];
    } else {
        // Si le mot de passe n'est pas fourni, ne pas le modifier
        $sql = "UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id_user";
        $params = [
            'id_user' => $user_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email
        ];
    }

    try {
        $query = $db->prepare($sql);
        $query->execute($params);

        if ($query->rowCount() > 0) {
            return "Profile updated successfully!";
        } else {
            return "No changes made to the profile.";
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}
public function desactiviercompte($user_id)
{
    $db = config::getConnexion();
    
    // Préparer la requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM user WHERE id = :id_user";
    $query = $db->prepare($sql);
    $query->bindValue(':id_user', $user_id);

    try {
        $query->execute();

        // Vérifier si la suppression a été effectuée avec succès
        if ($query->rowCount() > 0) {
            return "User deleted successfully!";
        } else {
            return "No user found with the given ID.";
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

}
?>
