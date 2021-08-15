<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UserBundle\Entity;

use EveryWorkflow\CoreBundle\Annotation\EWFDataTypes;
use EveryWorkflow\EavBundle\Entity\BaseEntity;

class UserEntity extends BaseEntity implements UserEntityInterface
{
    /**
     * @param string $code
     *
     * @return $this
     * @EWFDataTypes (type="string", front_type="text", mongofield=self::KEY_USERNAME, required=TRUE, minLength=5, maxLength=20,
     *     readonly=TRUE,  sortOrder=1)
     */
    public function setUsername($username)
    {
        $this->dataObject->setData(self::KEY_USERNAME, $username);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->dataObject->getData(self::KEY_USERNAME);
    }

    /**
     * @param string $code
     *
     * @return $this
     * @EWFDataTypes (type="string", front_type="text", mongofield=self::KEY_EMAIL, required=TRUE, minLength=5, maxLength=20,
     *     readonly=TRUE,  sortOrder=2)
     */
    public function setEmail($email)
    {
        $this->dataObject->setData(self::KEY_EMAIL, $email);

        return $this;
    }

    public function getEmail()
    {
        return $this->dataObject->getData(self::KEY_EMAIL);
    }

    /**
     * @param string $code
     *
     * @return $this
     * @EWFDataTypes (type="string", front_type="text",  mongofield=self::KEY_FIRST_NAME, required=TRUE, minLength=5, maxLength=20,
     *     readonly=TRUE,  sortOrder=3)
     */
    public function setFirstName($firstName)
    {
        $this->dataObject->setData(self::KEY_FIRST_NAME, $firstName);

        return $this;
    }

    public function getFirstName()
    {
        return $this->dataObject->getData(self::KEY_FIRST_NAME);
    }

    /**
     * @param string $code
     *
     * @return $this
     * @EWFDataTypes (type="string",front_type="text", mongofield=self::KEY_LAST_NAME, required=TRUE, minLength=5, maxLength=20,
     *     readonly=TRUE,  sortOrder=4)
     */
    public function setLastName($lastName)
    {
        $this->dataObject->setData(self::KEY_LAST_NAME, $lastName);

        return $this;
    }

    public function getLastName()
    {
        return $this->dataObject->getData(self::KEY_LAST_NAME);
    }

    /**
     * @param string $code
     *
     * @return $this
     * @EWFDataTypes (type="string", front_type="text", mongofield=self::KEY_DOB, required=TRUE, minLength=5, maxLength=20,
     *     readonly=TRUE,  sortOrder=5, canDelete=FALSE)
     */
    public function setDob($dob)
    {
        $this->dataObject->setData(self::KEY_DOB, $dob);

        return $this;
    }

    public function getDob()
    {
        return $this->dataObject->getData(self::KEY_DOB);
    }

    /**
     * @param string $code
     *
     * @return $this
     * @EWFDataTypes (type="string",front_type="text", required=TRUE, minLength=5, maxLength=20,
     *     readonly=TRUE,  sortOrder=5)
     */
    public function setMobile($dob)
    {
        $this->dataObject->setData(self::KEY_DOB, $dob);

        return $this;
    }

    public function getMobile()
    {
        return $this->dataObject->getData(self::KEY_DOB);
    }
}
