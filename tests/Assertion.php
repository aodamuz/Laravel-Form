<?php

namespace Aodamuz\Form\Tests;

use ReflectionClass;
use Codeception\AssertThrows;

trait Assertion
{
    use AssertThrows;

    /**
     * Asserts that a class uses a interface.
     *
     * @param string $interface
     * @param object|string $object
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     */
    protected function assertClassUsesInterface(string $interface, $object)
    {
        $object = is_object($object) ? get_class($object) : $object;

        $this->assertArrayHasKey(
            $interface,
            class_implements($object),
            "\"{$object}\" must use \"{$interface}\" interface"
        );
    }

    /**
     * Asserts that a class uses a trait.
     *
     * @param string $trait
     * @param object|string $object
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws Exception
     */
    protected function assertClassUsesTrait(string $trait, $object)
    {
        $object = is_object($object) ? get_class($object) : $object;

        $this->assertArrayHasKey(
            $trait,
            trait_uses_recursive($object),
            "\"{$object}\" must use \"{$trait}\" trait"
        );
    }

    /**
     * Asserts that a class is a subclass of a given class.
     *
     * @param object|string $child
     * @param object|string $parent
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    protected function assertSubclassOf($child, $parent)
    {
        $child  = is_object($child) ? get_class($child) : $child;
        $parent = is_object($parent) ? get_class($parent) : $parent;

        $this->assertTrue(
            is_subclass_of($child, $parent),
            "The \"{$child}\" class must be a subclass of \"{$parent}\"."
        );
    }

    /**
     * It asserts that a class is abstract.
     *
     * @param object|string $class
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     */
    protected function assertAbstractClass($class)
    {
        $reflection = new ReflectionClass($class);
        $class      = is_object($class) ? get_class($class) : $class;

        $this->assertTrue(
            $reflection->isAbstract(),
            "The \"{$class}\" class must be an abstract class."
        );
    }

    /**
     * Get the value of a protected or private property of a given class.
     *
     * @param object $object
     * @param string $property
     *
     * @return mixed
     */
    protected static function getClassProperty(object $object, string $property)
    {
        $reflection = (new \ReflectionClass($object))->getProperty($property);

        $reflection->setAccessible(true);

        return $reflection->getValue($object);
    }
}
