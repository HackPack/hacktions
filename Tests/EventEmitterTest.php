<?hh
namespace HackPack\Hacktions\Tests;

use HackPack\HackUnit\Core\TestCase;

class EventEmitterTest extends TestCase
{
    public function test_on_stores_listener_by_key(): void
    {
        $emitter = new TestEventEmitter();
        $emitter->on('test', (...) ==> {$x = 1;});

        $this->expect($emitter->getListeners()->count())->toEqual(1);
    }

    public function test_off_removes_listener(): void
    {
        $emitter = new TestEventEmitter();
        $lambda = (...) ==> {$x = 1;};
        $emitter->on('test', $lambda);
        $emitter->off('test', $lambda);

        $this->expect($emitter->getListeners()->count())->toEqual(0);
    }
}
