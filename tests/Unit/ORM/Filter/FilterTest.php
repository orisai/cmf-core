<?php declare(strict_types = 1);

namespace Tests\OriCMF\Core\Unit\ORM\Filter;

use OriCMF\Core\ORM\Filter\Filter;
use PHPUnit\Framework\TestCase;

final class FilterTest extends TestCase
{

	public function testDefault(): void
	{
		$filter = new Filter();

		self::assertSame([], $filter->find()->getConditions());
		self::assertSame([], $filter->order()->getOrder());
		self::assertSame([null, null], $filter->getLimit());
	}

	public function testLimit(): void
	{
		$filter = new Filter();

		self::assertSame([null, null], $filter->getLimit());

		$filter->limit(10, 5);
		self::assertSame([10, 5], $filter->getLimit());

		$filter->limit(10);
		self::assertSame([10, null], $filter->getLimit());
	}

}
