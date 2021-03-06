<?php

namespace Over_Code\Models\UserCrud;

use PDO;
use Over_Code\Db\DbConnect;

/**
 * Trait used to insert user in db
 */
trait Create
{
    /**
     * Query to create user
     *
     * @var string $query
     */
    private $query;

    /**
     * Create in database an user with status on 'pending',
     * from getPOST datas
     *
     * @param string $token
     * @param string $dateTime
     *
     * @return void
     */
    public function createUser(string $token, string $dateTime): void
    {
        //argon2id only available if PHP has been compiled with Argon2 support
        $algo = (defined('PASSWORD_ARGON2ID')) ? PASSWORD_ARGON2ID : PASSWORD_DEFAULT;

        $this->pdo = new DbConnect();

        $this->setQuery();

        $stmt = $this->pdo->getPdo()->prepare($this->query);

        $stmt->bindValue(':first_name', $this->getPOST('first_name'), PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $this->getPOST('last_name'), PDO::PARAM_STR);
        $stmt->bindValue(':pseudo', $this->getPOST('pseudo'), PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->getPOST('email'), PDO::PARAM_STR);
        $stmt->bindValue(':password', password_hash($this->getPOST('password'), $algo), PDO::PARAM_STR);
        $stmt->bindValue(':avatar_id', (int)$this->getPOST('avatar_id'), PDO::PARAM_INT);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->bindValue(':token_datetime', $dateTime, PDO::PARAM_STR);
        $stmt->bindValue(':user_status_id', 1, PDO::PARAM_INT);
        $stmt->bindValue(':created_at', $dateTime, PDO::PARAM_STR);

        $stmt->execute();
    }

    /**
     * Sets prepared query to create user
     *
     * @return void
     */
    private function setQuery(): void
    {
        $this->query = 'INSERT INTO user (
            first_name,
            last_name,
            pseudo,
            email,
            password,
            avatar_id,
            token,
            token_datetime,
            user_status_id,
            created_at)
        VALUES (
            :first_name,
            :last_name,
            :pseudo,
            :email,
            :password,
            :avatar_id,
            :token,
            :token_datetime,
            :user_status_id,
            :created_at)';
    }
}
