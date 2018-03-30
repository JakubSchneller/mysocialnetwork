<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;
use Nette\Utils\DateTime;

/**
 * Users management.
 */
class UserManager implements Nette\Security\IAuthenticator
{
	use Nette\SmartObject;

	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'user_id',
		COLUMN_NAME = 'user_name',
		COLUMN_PASSWORD_HASH = 'user_pass',
		COLUMN_EMAIL = 'user_email',
		COLUMN_ROLE = 'role',
	    COLUMN_DATE = 'date_created',
	    COLUMN_SURNAME = 'first_name',
        COLUMN_LASTNAME = 'last_name',
        COLUMN_ABOUTME = 'about_me',
        COLUMN_IMAGE = 'image',
        COLUMN_HEADER = 'header';


	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)
			->where(self::COLUMN_NAME, $username)
			->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('Jméno je nesprávné.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
            throw new Nette\Security\AuthenticationException('Heslo je nesprávné', self::IDENTITY_NOT_FOUND);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update([
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			]);
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return void
	 * @throws DuplicateNameException
	 */
	public function add($username, $email, $password, $surname, $lastname, $aboutme, $image, $header)
	{
		try {
			$this->database->table(self::TABLE_NAME)->insert([
				self::COLUMN_NAME => $username,
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
				self::COLUMN_EMAIL => $email,
                self::COLUMN_ROLE => "user",
                self::COLUMN_DATE => new DateTime,
                self::COLUMN_SURNAME => $surname,
                self::COLUMN_LASTNAME => $lastname,
                self::COLUMN_ABOUTME => $aboutme,
                self::COLUMN_IMAGE => $image,
                self::COLUMN_HEADER => $header

			]);
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
	}
}



class DuplicateNameException extends \Exception
{
}
