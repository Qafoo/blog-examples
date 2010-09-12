<?php

require_once dirname( __FILE__ ) . '/invalid_argument_exception.php';

class qaPerson
{
    const GENDER_MALE = 1;

    const GENDER_FEMALE = 2;

    protected $firstName;

    protected $lastName;

    protected $gender;

    protected $dateOfBirth;

    public function __construct(
        $lastName,
        $firstName
    ) {
        $this->setLastName( $lastName );
        $this->setFirstName( $firstName );
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName( $lastName )
    {
        if ( false === is_string( $lastName ) )
        {
            throw new qaInvalidArgumentException(
                'lastName',
                $lastName,
                'string'
            );
        }
        $this->lastName = $lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName( $firstName )
    {
        if ( false === is_string( $firstName ) )
        {
            throw new qaInvalidArgumentException(
                'firstName',
                $firstName,
                'string'
            );
        }
        $this->firstName = $firstName;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender( $gender )
    {
        if ( false === is_int( $gender )
            || ( $gender !== self::GENDER_MALE && $gender !== self::GENDER_FEMALE )
        ) {
            throw new qaInvalidArgumentException(
                'gender',
                $gender,
                sprintf(
                    'int, %s or %s',
                    self::GENDER_MALE,
                    self::GENDER_FEMALE
                )
            );
        }
        $this->gender = $gender;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth( DateTime $dateOfBirth )
    {
        $this->dateOfBirth = $dateOfBirth;
    }
}

?>
