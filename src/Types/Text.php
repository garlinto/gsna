<?php
/**
 * Define Postgresql "text" datatype
 * Default char type Doctrine will want to use
 *	is VARCHAR which is not the most efficient string or char
 *	type for Postgresql. However, text is the simplest and best option
 *	to use for storing strings when using Postgres.
 *
 */
namespace gsna\src\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Postgresql "TEXT" type
 */
class Text extends Type
{
    const TEXT = 'text'; // modify to match your type name

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        // return the SQL used to create your column type. To create a portable column type, use the $platform.
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // This is executed when the value is read from the database. Make your conversions here, optionally using the $platform.
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // This is executed when the value is written to the database. Make your conversions here, optionally using the $platform.
    }

    public function getName()
    {
        return self::MYTYPE; // modify to match your constant name
    }
}