<?php
namespace Polidog\Chatwork\Entity\Factory;


use Polidog\Chatwork\Entity\Collection\CollectionInterface;
use Polidog\Chatwork\Entity\EntityInterface;

class AbstractFactoryTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @test
     */
    public function コレクションオブジェクトを生成することができる()
    {
        $factory = new TestFactory();
        $actual = $factory->collection([
            [
                'a' => 1,
                'b' => 2,
            ],
            [
                'a' => 3,
                'b' => 4,
            ],
        ]);
        
        $this->assertInstanceOf(CollectionInterface::class, $actual);
        $this->assertCount(2, $actual);
        
        foreach ($actual as $entity) {
            $this->assertInstanceOf(EntityInterface::class, $entity);
        }
        
    }
}

class TestFactory extends AbstractFactory
{
    /**
     * @param array $data
     * @return TestEntity
     */
    public function entity(array $data = [])
    {
        $entity = new TestEntity();
        $entity->a = $data['a'];
        $entity->b = $data['b'];
        
        return $entity;
    }
}

class TestEntity implements EntityInterface
{
    public $a;
    public $b;
}