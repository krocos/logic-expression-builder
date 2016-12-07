<?php

namespace Tests;

use Krocos\LogicExpressionBuilder\Builder;
use Krocos\LogicExpressionBuilder\OperandInterface;

class BuildingLogicExpressionTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $namCompare = new class implements OperandInterface {
            private $num;
            public function setNumber(int $num) {
                $this->num = $num;

                return $this;
            }
            /**
             * @return bool
             */
            public function toBool()
            {
                return $this->num > 50;
            }
        };

        $liquidReturn = new class implements OperandInterface {
            private $bool;
            public function setBoolToReturn(bool $bool) {
                $this->bool = $bool;

                return $this;
            }
            /**
             * @return bool
             */
            public function toBool()
            {
                return $this->bool;
            }
        };

        $this->assertFalse(
            (new Builder())
                ->x(true)
                ->andX($namCompare->setNumber(100)->toBool())
                ->orX($liquidReturn->setBoolToReturn(true)->toBool())
                ->xorX($liquidReturn->setBoolToReturn(false)->toBool())
                ->andNotX($liquidReturn->setBoolToReturn(true)->toBool())
                ->orNotX($liquidReturn->setBoolToReturn(false)->toBool())
                ->xorNotX($liquidReturn->setBoolToReturn(true)->toBool())
                ->andOpenBrace()
                    ->openBrace()
                        ->notX(5 >= 8)
                        ->orX(8 == 9)
                    ->closeBrace()
                    ->orOpenBrace()
                        ->x(false)
                        ->xorX(true)
                    ->closeBrace()
                    ->andNotOpenBrace()
                        ->notOpenBrace()
                            ->x(true)
                            ->orNotX(false)
                        ->closeBrace()
                        ->orNotOpenBrace()
                            ->notX(false)
                            ->andX(true)
                            ->xorNotOpenBrace()
                                ->x(true)
                                ->andX(true)
                            ->closeBrace()
                            ->xorOpenBrace()
                                ->notX(true)
                                ->andNotX(false)
                            ->closeBrace()
                        ->closeBrace()
                    ->closeBrace()
                ->closeBrace()
                ->toBool()
        );
    }
}
