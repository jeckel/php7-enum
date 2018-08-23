<?php
namespace Test\PHP7Enum\Fixtures;

use PHP7Enum\EnumAbstract;

/**
 * Class StatusEnum
 *
 * @method static DRAFT(): StatusEnum
 * @method static VALID(): StatusEnum
 * @method static DELETED(): StatusEnum
 */
class StatusEnum extends EnumAbstract
{
    const DRAFT = 'draft';
    const VALID = 'valid';
    const DELETED = 'deleted';
}