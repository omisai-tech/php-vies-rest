<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Model;

use Omisai\ViesRest\ObjectSerializer;

class CheckVatRequest implements \ArrayAccess, \JsonSerializable, ModelInterface
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'CheckVatRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'country_code' => 'string',
        'vat_number' => 'string',
        'requester_member_state_code' => 'string',
        'requester_number' => 'string',
        'trader_name' => 'string',
        'trader_street' => 'string',
        'trader_postal_code' => 'string',
        'trader_city' => 'string',
        'trader_company_type' => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @var string[]
     *
     * @phpstan-var array<string, string|null>
     *
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'country_code' => null,
        'vat_number' => null,
        'requester_member_state_code' => null,
        'requester_number' => null,
        'trader_name' => null,
        'trader_street' => null,
        'trader_postal_code' => null,
        'trader_city' => null,
        'trader_company_type' => null,
    ];

    /**
     * Array of nullable properties. Used for (de)serialization.
     *
     * @var bool[]
     */
    protected static array $openAPINullables = [
        'country_code' => false,
        'vat_number' => false,
        'requester_member_state_code' => false,
        'requester_number' => false,
        'trader_name' => false,
        'trader_street' => false,
        'trader_postal_code' => false,
        'trader_city' => false,
        'trader_company_type' => false,
    ];

    /**
     * If a nullable field gets set to null, insert it here.
     *
     * @var bool[]
     */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'country_code' => 'countryCode',
        'vat_number' => 'vatNumber',
        'requester_member_state_code' => 'requesterMemberStateCode',
        'requester_number' => 'requesterNumber',
        'trader_name' => 'traderName',
        'trader_street' => 'traderStreet',
        'trader_postal_code' => 'traderPostalCode',
        'trader_city' => 'traderCity',
        'trader_company_type' => 'traderCompanyType',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'country_code' => 'setCountryCode',
        'vat_number' => 'setVatNumber',
        'requester_member_state_code' => 'setRequesterMemberStateCode',
        'requester_number' => 'setRequesterNumber',
        'trader_name' => 'setTraderName',
        'trader_street' => 'setTraderStreet',
        'trader_postal_code' => 'setTraderPostalCode',
        'trader_city' => 'setTraderCity',
        'trader_company_type' => 'setTraderCompanyType',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'country_code' => 'getCountryCode',
        'vat_number' => 'getVatNumber',
        'requester_member_state_code' => 'getRequesterMemberStateCode',
        'requester_number' => 'getRequesterNumber',
        'trader_name' => 'getTraderName',
        'trader_street' => 'getTraderStreet',
        'trader_postal_code' => 'getTraderPostalCode',
        'trader_city' => 'getTraderCity',
        'trader_company_type' => 'getTraderCompanyType',
    ];

    /**
     * Associative array for storing property values.
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor.
     *
     * @param  null|mixed[]  $data  Associated array of property values
     *                              initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('country_code', $data ?? [], null);
        $this->setIfExists('vat_number', $data ?? [], null);
        $this->setIfExists('requester_member_state_code', $data ?? [], null);
        $this->setIfExists('requester_number', $data ?? [], null);
        $this->setIfExists('trader_name', $data ?? [], null);
        $this->setIfExists('trader_street', $data ?? [], null);
        $this->setIfExists('trader_postal_code', $data ?? [], null);
        $this->setIfExists('trader_city', $data ?? [], null);
        $this->setIfExists('trader_company_type', $data ?? [], null);
    }

    /**
     * Gets the string presentation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Checks if a property is nullable.
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        return [];
    }

    /**
     * Validate all the properties in the model
     * return true if all passed.
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }

    /**
     * Gets country_code.
     *
     * @return null|string
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code.
     *
     * @param  null|string  $country_code  country_code
     *
     * @return self
     */
    public function setCountryCode($country_code)
    {
        if (is_null($country_code)) {
            throw new \InvalidArgumentException('non-nullable country_code cannot be null');
        }
        $this->container['country_code'] = $country_code;

        return $this;
    }

    /**
     * Gets vat_number.
     *
     * @return null|string
     */
    public function getVatNumber()
    {
        return $this->container['vat_number'];
    }

    /**
     * Sets vat_number.
     *
     * @param  null|string  $vat_number  vat_number
     *
     * @return self
     */
    public function setVatNumber($vat_number)
    {
        if (is_null($vat_number)) {
            throw new \InvalidArgumentException('non-nullable vat_number cannot be null');
        }
        $this->container['vat_number'] = $vat_number;

        return $this;
    }

    /**
     * Gets requester_member_state_code.
     *
     * @return null|string
     */
    public function getRequesterMemberStateCode()
    {
        return $this->container['requester_member_state_code'];
    }

    /**
     * Sets requester_member_state_code.
     *
     * @param  null|string  $requester_member_state_code  requester_member_state_code
     *
     * @return self
     */
    public function setRequesterMemberStateCode($requester_member_state_code)
    {
        if (is_null($requester_member_state_code)) {
            throw new \InvalidArgumentException('non-nullable requester_member_state_code cannot be null');
        }
        $this->container['requester_member_state_code'] = $requester_member_state_code;

        return $this;
    }

    /**
     * Gets requester_number.
     *
     * @return null|string
     */
    public function getRequesterNumber()
    {
        return $this->container['requester_number'];
    }

    /**
     * Sets requester_number.
     *
     * @param  null|string  $requester_number  requester_number
     *
     * @return self
     */
    public function setRequesterNumber($requester_number)
    {
        if (is_null($requester_number)) {
            throw new \InvalidArgumentException('non-nullable requester_number cannot be null');
        }
        $this->container['requester_number'] = $requester_number;

        return $this;
    }

    /**
     * Gets trader_name.
     *
     * @return null|string
     */
    public function getTraderName()
    {
        return $this->container['trader_name'];
    }

    /**
     * Sets trader_name.
     *
     * @param  null|string  $trader_name  trader_name
     *
     * @return self
     */
    public function setTraderName($trader_name)
    {
        if (is_null($trader_name)) {
            throw new \InvalidArgumentException('non-nullable trader_name cannot be null');
        }
        $this->container['trader_name'] = $trader_name;

        return $this;
    }

    /**
     * Gets trader_street.
     *
     * @return null|string
     */
    public function getTraderStreet()
    {
        return $this->container['trader_street'];
    }

    /**
     * Sets trader_street.
     *
     * @param  null|string  $trader_street  trader_street
     *
     * @return self
     */
    public function setTraderStreet($trader_street)
    {
        if (is_null($trader_street)) {
            throw new \InvalidArgumentException('non-nullable trader_street cannot be null');
        }
        $this->container['trader_street'] = $trader_street;

        return $this;
    }

    /**
     * Gets trader_postal_code.
     *
     * @return null|string
     */
    public function getTraderPostalCode()
    {
        return $this->container['trader_postal_code'];
    }

    /**
     * Sets trader_postal_code.
     *
     * @param  null|string  $trader_postal_code  trader_postal_code
     *
     * @return self
     */
    public function setTraderPostalCode($trader_postal_code)
    {
        if (is_null($trader_postal_code)) {
            throw new \InvalidArgumentException('non-nullable trader_postal_code cannot be null');
        }
        $this->container['trader_postal_code'] = $trader_postal_code;

        return $this;
    }

    /**
     * Gets trader_city.
     *
     * @return null|string
     */
    public function getTraderCity()
    {
        return $this->container['trader_city'];
    }

    /**
     * Sets trader_city.
     *
     * @param  null|string  $trader_city  trader_city
     *
     * @return self
     */
    public function setTraderCity($trader_city)
    {
        if (is_null($trader_city)) {
            throw new \InvalidArgumentException('non-nullable trader_city cannot be null');
        }
        $this->container['trader_city'] = $trader_city;

        return $this;
    }

    /**
     * Gets trader_company_type.
     *
     * @return null|string
     */
    public function getTraderCompanyType()
    {
        return $this->container['trader_company_type'];
    }

    /**
     * Sets trader_company_type.
     *
     * @param  null|string  $trader_company_type  trader_company_type
     *
     * @return self
     */
    public function setTraderCompanyType($trader_company_type)
    {
        if (is_null($trader_company_type)) {
            throw new \InvalidArgumentException('non-nullable trader_company_type cannot be null');
        }
        $this->container['trader_company_type'] = $trader_company_type;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param  int|string  $offset  Offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param  int|string  $offset  Offset
     *
     * @return null|mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param  null|int  $offset  Offset
     * @param  mixed  $value  Value to be set
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param  int|string  $offset  Offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @see https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed returns data which can be serialized by json_encode(), which is a value
     *               of any type other than a resource
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets a header-safe presentation of the object.
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }

    /**
     * Array of nullable properties.
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null.
     *
     * @return bool[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null.
     *
     * @param  bool[]  $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
     * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
     * $this->openAPINullablesSetToNull array.
     *
     * @param  mixed  $defaultValue
     */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }
}
