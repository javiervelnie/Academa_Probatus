<?php

class userClass
{

    /* User Registration */
    public function userRegistration($dni, $nombre, $apellidos, $email, $password1, $password2)
    {
        try {
            $db = getDB();
            $st = $db->prepare("SELECT id FROM alumnos WHERE email=:email");
            $st->bindParam("email", $email, PDO::PARAM_STR);
            $st->execute();
            $count = $st->rowCount();
            if ($count < 1) {
                $stmt = $db->prepare("INSERT INTO alumnos(dni,nombre,apellidos,email,password1,password2) 
                VALUES (:dni,:nombre,:apellidos,:email,:hash_password1,:hash_password1)");
                $hash_password1 = hash('sha256', $password1); //Password encryption
                $hash_password2 = hash('sha256', $password2); //Password encryption
                $stmt->bindParam("hash_password1", $hash_password1, PDO::PARAM_STR);
                $stmt->bindParam("hash_password2", $hash_password2, PDO::PARAM_STR);
                $stmt->bindParam("email", $email, PDO::PARAM_STR);
                $stmt->bindParam("dni", $dni, PDO::PARAM_STR);
                $stmt->bindParam("nombre", $nombre, PDO::PARAM_STR);
                $stmt->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
                $stmt->execute();
                $id = $db->lastInsertId(); // Last inserted row id
                $db = null;
                $_SESSION['id'] = $id;
                return true;
            } else {
                $db = null;
                return false;
            }
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
}
