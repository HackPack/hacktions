<?hh //strict
namespace HackPack\Hacktions\Tests;

use HackPack\HackUnit\Core\TestCase;
use HackPack\Hacktions\Publisher;
use HackPack\Hacktions\ArgumentList;

newtype TestStruct = shape('x' => int, 'y' => int);

class PublisherTest extends TestCase
{
    public function test_addSubscriber_should_add_subscriber_object(): void
    {
        $vector = Vector {};
        $publisher = new TestPublisher();
        $publisher->on('eventName', function(Vector<int> $args) {
            $args->add(1);
        });
        $publisher->trigger('eventName', $vector);
        $this->expect($vector->linearSearch(1))->toEqual(0);
    }
}

