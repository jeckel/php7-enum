<?php
namespace PHP7Enum;

/**
 * Class EnumAbstract
 *
 * This class allow to create Real Enum type, you can then easily validate that force a value to be in the required type
 */
class EnumAbstract implements \JsonSerializable
{
    /** @var array */
    static protected $allowedValues = [];

    /** @var array */
    static protected $cache = [];

    /** @var mixed */
    protected $value;

    /**
     * EnumAbstract constructor.
     * Prevent use of constructor, to create a value, see __callStatic
     * @param mixed $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    static public function toArray(): array
    {
        $class = static::class;
        if (empty(static::$allowedValues[$class])) {
            $reflection = new \ReflectionClass($class);
            static::$allowedValues[$class] = $reflection->getConstants();
        }

        return static::$allowedValues[$class];
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->getValue();
    }

    /**
     * This method is the main way to retrieve an Enum value
     * Returns a value when called statically like so: MyEnum::SOME_VALUE() given SOME_VALUE is a class constant
     * The object returned is then a valid instance of MyEnum, with the value of SOME_VALUE
     *
     * If you retrieve twice for the same value, it will returned the same instance, you can then compare them
     *
     * @param string $name
     * @param array  $arguments
     * @return EnumAbstract
     * @throws \ReflectionException
     */
    static public function __callStatic(string $name, array $arguments = [])
    {
        $array = static::toArray();
        if (! isset($array[$name])) {
            throw new UnexpectedValueException(sprintf(
                'Invalid name "%s" for enum "%s"',
                $name,
                static::class
            ));
        }
        $value = $array[$name];

        if (! isset(static::$cache[$value])) {
            static::$cache[$value] = new static($value);
        }

        return static::$cache[$value];
    }

    /**
     * @param string $value
     * @return EnumAbstract
     * @throws \ReflectionException
     */
    static public function fromValue(string $value): EnumAbstract
    {
        $array = static::toArray();
        if (! in_array($value, $array)) {
            throw new UnexpectedValueException(sprintf(
                'Invalid value "%s" for enum "%s"',
                $value,
                static::class
            ));
        }

        if (! isset(static::$cache[$value])) {
            static::$cache[$value] = new static($value);
        }

        return static::$cache[$value];
    }
}