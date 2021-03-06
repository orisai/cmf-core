<?php declare(strict_types = 1);

namespace OriCMF\Core\ORM\Wrapper;

use MabeEnum\Enum;
use Orisai\Exceptions\Logic\InvalidArgument;
use function array_key_first;
use function assert;
use function count;
use function is_string;
use function is_subclass_of;

final class EnumValueWrapper extends ValuePropertyWrapper
{

	public function convertToRawValue(mixed $value): mixed
	{
		assert($value instanceof Enum);

		return $value->getValue();
	}

	public function convertFromRawValue(mixed $value): Enum
	{
		assert(is_string($value));

		$types = $this->propertyMetadata->types;

		if (count($types) !== 1) {
			throw InvalidArgument::create()
				->withMessage('Property must have one and only one type defined.');
		}

		$type = array_key_first($types);
		assert(is_subclass_of($type, Enum::class));

		return $type::byValue($value);
	}

}
